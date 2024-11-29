<?php
namespace App\Notifications;

use App\Models\Oeuvre;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AnnulerVenteOeuvreNotification extends Notification
{
    use Queueable;

    public $oeuvre;

    public function __construct(Oeuvre $oeuvre)
    {
        $this->oeuvre = $oeuvre;
    }

    // Utiliser les canaux email et base de données
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // Message pour la base de données
    public function toDatabase($notifiable)
    {
        return [
            'message' => "L'œuvre '{$this->oeuvre->nom}' est utilisée dans une vente en cours. Veuillez annuler cette vente pour que l'utilisateur puisse supprimer l'œuvre.",
            'oeuvre_id' => $this->oeuvre->id,
            'url' => route('oeuvres.show', $this->oeuvre->id),
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "L'œuvre '{$this->oeuvre->nom}' est utilisée dans une vente en cours. Veuillez annuler cette vente pour que l'utilisateur puisse supprimer l'œuvre.",
            'oeuvre_id' => $this->oeuvre->id,
            'url' => route('oeuvres.show', $this->oeuvre->id),
        ];
    }

    // Message pour l'email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Annulation requise : vente liée à une œuvre")
            ->greeting("Bonjour, {$notifiable->name}")
            ->line("Un utilisateur souhaite supprimer l'œuvre '{$this->oeuvre->nom}' mais elle est actuellement utilisée dans une vente en cours.")
            ->line("Veuillez supprimer cette oeuvre de la vente dans les plus brefs délais, ou contacter l'utilisateur pour en savoir plus.")
            ->action('Voir l\'œuvre', route('oeuvres.show', $this->oeuvre->id))
            ->line('Merci de votre attention.');
    }
}
