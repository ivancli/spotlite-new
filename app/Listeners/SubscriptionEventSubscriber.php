<?php
namespace App\Listeners;

use App\Jobs\LogUserActivity;

//use App\Jobs\LogUserActivity;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 8/30/2016
 * Time: 4:58 PM
 */
class SubscriptionEventSubscriber
{
    /**
     * On subscription management page viewed
     * @param $event
     */
    public function onManagementViewed($event)
    {
        dispatch((new LogUserActivity(auth()->user(), "viewed subscription management page"))->onQueue("logging"));
    }

    public function onCreating($event)
    {
        dispatch((new LogUserActivity(auth()->user(), "creating subscription"))->onQueue("logging"));
    }

    public function onCompleted($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "completed subscription, id: {$subscription->getKey()}"))->onQueue("logging"));
    }

    public function onEditViewed($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "viewed edit subscription page, id: {$subscription->getKey()}"))->onQueue("logging"));
    }

    public function onUpdating($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "updating subscription, id: {$subscription->getKey()}"))->onQueue("logging"));
    }

    public function onUpdated($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "updated subscription, id: {$subscription->getKey()}"))->onQueue("logging"));
    }

    public function onCancelling($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "cancelling subscription, id: {$subscription->getKey()}"))->onQueue("logging"));
    }

    public function onCancelled($event)
    {
        $subscription = $event->subscription;
        dispatch((new LogUserActivity(auth()->user(), "cancelled subscription, id: {$subscription->getKey()}"))->onQueue("logging"));
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Subscription\SubscriptionManagementViewed',
            'App\Listeners\SubscriptionEventSubscriber@onManagementViewed'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionCreating',
            'App\Listeners\SubscriptionEventSubscriber@onCreating'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionCompleted',
            'App\Listeners\SubscriptionEventSubscriber@onCompleted'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionEditViewed',
            'App\Listeners\SubscriptionEventSubscriber@onEditViewed'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionUpdating',
            'App\Listeners\SubscriptionEventSubscriber@onUpdating'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionUpdated',
            'App\Listeners\SubscriptionEventSubscriber@onUpdated'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionCancelling',
            'App\Listeners\SubscriptionEventSubscriber@onCancelling'
        );
        $events->listen(
            'App\Events\Subscription\SubscriptionCancelled',
            'App\Listeners\SubscriptionEventSubscriber@onCancelled'
        );
    }
}