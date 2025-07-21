@component('mail::message')
# Bonjour {{ $user->name ?? $user->nom ?? 'Entrepreneur' }},

@if($statut === 'approuve')
Votre demande de stand a été **approuvée** ! 🎉

Vous pouvez maintenant accéder à votre espace entrepreneur sur la plateforme Eat&Drink.
@else
Votre demande de stand a été **rejetée**.
@if($motif)

**Motif du rejet :**
> {{ $motif }}
@endif

Vous pouvez contacter l'administration pour plus d'informations.
@endif

Merci pour votre intérêt pour Eat&Drink !

Cordialement,
L'équipe Eat&Drink
@endcomponent
