@extends('layouts.adminlte')
@section('title', "Manage Subscription")
@section('header_title', "Manage Subscription")
@section('breadcrumbs')
    {!! Breadcrumbs::render('subscription_index') !!}
@stop
@section('content')
    <div class="row subscription-info-panel">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Current Subscription</h3>

                    <div class="box-tools pull-right">
                        Reference ID: {{$subscription->customer->id}}
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>You are currently subscribed to <strong>{{$subscription->product->name}}</strong>
                                package.</p>
                            <p>Next payment will be processed on
                                <strong>{{date('Y-m-d', strtotime($subscription->next_assessment_at))}}</strong>.
                            </p>
                            @if(!is_null($subscription->trial_ended_at))
                                <p>Your trial will be ended on
                                    {{date('Y-m-d', strtotime($subscription->trial_ended_at))}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            {{--@if(isset($portalLink))--}}
                            {{--<a href="{{$portalLink}}" class="btn btn-default">--}}
                            {{--Access Chargify Billing Portal--}}
                            {{--</a>--}}
                            {{--@endif--}}
                            <a href="{{$updatePaymentLink}}" class="btn btn-default">
                                Update Payment Details
                            </a>
                            <a href="{{route('subscription.edit', $sub->getKey())}}" class="btn btn-default">
                                Change My Plan
                            </a>
                            <button class="btn btn-default" onclick="toggleCancelSubscriptionPanel(); return false;">
                                Cancel Subscription
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row cancel-subscription-panel">
        <div class="col-sm-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h4 class="box-title text-danger"><i class="fa fa-info-circle"></i> Are you sure you want to cancel
                        your subscription?</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Form::model($sub, array('route' => array('subscription.destroy', $sub->getKey()), 'class'=>'form-horizontal', 'method' => 'delete', 'onsubmit'=>'return confirm("Do you want to cancel this subscription package? Please be aware of that this action cannot be undone.")')) !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>If you choose to cancel your subscription, you will no long be able to track your
                                        competitors prices.</p>
                                    <p class="text-danger">NOTE: you will not be able to undo this cancellation.</p>

                                    <div class="well">
                                        <p class="text-danger">
                                            <small>[Camila and Michael to work on terms and conditions, the words below
                                                are
                                                only an example]
                                            </small>
                                        </p>
                                        <p>Would you like to keep your profile in SpotLite just so you don't need to
                                            sign up
                                            again when you change your mind.</p>
                                        <p class="text-danger">
                                            <small>[description here to indicate what we keep in SpotLite (or maybe
                                                Chargify?]
                                            </small>
                                        </p>
                                        <p class="text-danger">
                                            <small>[description should also mention about the drawback of removing
                                                profile]
                                            </small>
                                        </p>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="keep_profile" value="1"> Yes, I agree to
                                                keep my profile in SpotLite
                                                <small class="text-danger">(and Chargify?)</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <button class="btn btn-default" id="btn-cancel-cancel"
                                                    onclick="toggleCancelSubscriptionPanel();return false;">
                                                No, go back
                                            </button>

                                            {!! Form::submit('Yes, cancel my subscription', ["class"=>"btn btn-default"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function toggleCancelSubscriptionPanel() {
                var $cancelSubscriptionPanel = $(".cancel-subscription-panel");
                var $subscriptionPanel = $(".subscription-info-panel");
                if ($cancelSubscriptionPanel.is(":visible")) {
                    $subscriptionPanel.slideDown();
                    $cancelSubscriptionPanel.slideUp();
                } else {
                    $subscriptionPanel.slideUp();
                    $cancelSubscriptionPanel.slideDown();
                }
            }
        </script>
    </div>
@stop