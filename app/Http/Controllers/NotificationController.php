<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Notifications non lues de l'utilisateur authentifié
        $notifications = auth()->user()->notifications;

        return view('dashboard', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Trouver la notification et la marquer comme lue
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Notification marquée comme lue.');
    }
}
