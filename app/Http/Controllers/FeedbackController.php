<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Local;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index($localId): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $local = Local::with('feedbacks.user')->findOrFail($localId);
        return view('feedback.index', compact('local'));
    }

    public function store(Request $request, $localId): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'rating' => 'nullable|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $local = Local::findOrFail($localId);

        if (!$request->input('rating') && !$request->input('comment')) {
            return redirect()->back()->withErrors('Você deve fornecer pelo menos uma avaliação ou um comentário.');
        }

        $feedback = new Feedback();
        $feedback->locals_id = $local->id;
        $feedback->users_id = auth()->id();
        $feedback->rating = $request->input('rating');
        $feedback->comment = $request->input('comment');
        $feedback->save();

        return redirect()->route('locals.show', $local->id)->with('success', 'Comentário adicionado com sucesso!');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $feedback = Feedback::findOrFail($id);

        // Verifica se o usuário é o proprietário do feedback
        if (auth()->id() !== $feedback->users_id) {
            abort(403, 'Você não tem permissão para editar este comentário.');
        }

        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'rating' => 'nullable|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $feedback = Feedback::findOrFail($id);

        // Verifica se o usuário é o proprietário do feedback
        if (auth()->id() !== $feedback->users_id) {
            abort(403, 'Você não tem permissão para editar este comentário.');
        }

        $feedback->rating = $request->input('rating', $feedback->rating);
        $feedback->comment = $request->input('comment', $feedback->comment);
        $feedback->save();

        return redirect()->route('locals.show', $feedback->locals_id)->with('success', 'Comentário atualizado com sucesso!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $feedback = Feedback::findOrFail($id);

        // Verifica se o usuário é o proprietário do feedback
        if (auth()->id() !== $feedback->users_id) {
            abort(403, 'Você não tem permissão para eliminar este comentário.');
        }

        $feedback->delete();

        return redirect()->route('locals.show', $feedback->locals_id)->with('success', 'Comentário eliminado com sucesso!');
    }
}
