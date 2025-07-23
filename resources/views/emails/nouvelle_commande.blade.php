@component('mail::message')
# Nouvelle commande sur votre stand : {{ $stand->nom_stand ?? '-' }}

Bonjour {{ $stand->user->name ?? $stand->user->nom ?? 'Entrepreneur' }},

Vous avez reçu une nouvelle commande sur votre stand !

## Détail de la commande :
<ul>
@foreach(is_array($commande->details_commande) ? $commande->details_commande : json_decode($commande->details_commande, true) as $item)
<li>{{ $item['nom'] }} x {{ $item['quantite'] }} ({{ number_format($item['prix'], 2) }} €)</li>
@endforeach
</ul>

Date de la commande : {{ $commande->created_at->format('d/m/Y H:i') }}

Merci d’assurer le suivi auprès du client si besoin.

Cordialement,
L’équipe Eat&Drink
@endcomponent
