<?php

namespace App\Notifications;

use App\Models\Vente;
use App\Models\Oeuvre;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class OeuvrePlacedInVente extends Notification
{
    use Queueable;

    protected $oeuvre;
    protected $vente;

    public function __construct(Oeuvre $oeuvre, Vente $vente)
    {
        $this->oeuvre = $oeuvre;
        $this->vente = $vente;
    }

    // Définir le canal de notification (mail, base de données, etc.)
    public function via($notifiable)
    {
        return ['mail', 'database']; // Envoyer par email et enregistrer en base
    }

    // Format du mail
    public function toMail($notifiable)
    {
        // Si la date n'est pas déjà un objet Carbon, on la convertit en un objet Carbon
        $dateVente = Carbon::parse($this->vente->date);

        return (new MailMessage)
                    ->subject('Votre œuvre a été ajoutée à une vente')
                    ->line('Bonjour,')
                    ->line('Votre œuvre "' . $this->oeuvre->nom . '" a été ajoutée à la vente "' . $this->vente->lieu . '" qui aura lieu le ' . $dateVente->format('d-m-Y') . '.')
                    ->line('Vous pouvez consulter la vente dans votre tableau de bord.');
    }

    // Format pour la notification en base de données
    public function toDatabase($notifiable)
    {
        return [
            'oeuvre_id' => $this->oeuvre->id,
            'vente_id' => $this->vente->id,
            'message' => 'Votre œuvre "' . $this->oeuvre->nom . '" a été ajoutée à la vente "' . $this->vente->lieu . '".'
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'oeuvre_id' => $this->oeuvre->id,
            'vente_id' => $this->vente->id,
            'message' => 'Votre œuvre "' . $this->oeuvre->nom . '" a été ajoutée à la vente "' . $this->vente->lieu . '".'
        ];
    }
}
