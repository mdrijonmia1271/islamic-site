<?php

namespace App\Http\Controllers;

use App\Models\QuizCategory;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display all active quiz categories.
     */
    public function index()
    {
        $categories = QuizCategory::where('status', true)
            ->withCount([
                'questions' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->get();

        return view('quiz.index', compact('categories'));
    }

    /**
     * Start quiz for a specific category.
     */
    public function start(QuizCategory $category)
    {
        $questions = $category->questions()
            ->where('status', true)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($questions->isEmpty()) {
            return redirect()->route('quiz.index')
                ->with('error', 'এই ক্যাটাগরিতে এখনো কোনো সক্রিয় প্রশ্ন যুক্ত করা হয়নি।');
        }

        return view('quiz.play', compact('category', 'questions'));
    }

    /**
     * Submit quiz answers and calculate results.
     */
    public function submit(Request $request, QuizCategory $category)
    {
        $answers = $request->input('answers', []);

        // Fetch all active questions that were presented
        $questionIds = $request->input('question_ids', array_keys($answers));

        $questions = $category->questions()
            ->where('status', true)
            ->whereIn('id', $questionIds)
            ->get();

        $totalQuestions = $questions->count();
        $score = 0;
        $correctCount = 0;
        $wrongCount = 0;
        $unansweredCount = 0;

        foreach ($questions as $question) {
            $userAns = $answers[$question->id] ?? null;
            if ($userAns === null) {
                $unansweredCount++;
            } elseif (strtolower($userAns) === strtolower($question->correct_answer)) {
                $score++;
                $correctCount++;
            } else {
                $wrongCount++;
            }
        }

        $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

        return view('quiz.result', compact(
            'category',
            'questions',
            'answers',
            'score',
            'totalQuestions',
            'correctCount',
            'wrongCount',
            'unansweredCount',
            'percentage'
        ));
    }
}
