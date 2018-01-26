@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Adesão de planos</h3>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Plano</th>
                        <th>Dt. de expiração</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{$subscription->order->user->name}}</td>
                        <td>{{$subscription->plan->name}}</td>
                        <td>{{\Carbon\Carbon::parse($subscription->expires_at)->format('d/m/Y')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {!! $subscriptions->links() !!}
    </div>

@endsection