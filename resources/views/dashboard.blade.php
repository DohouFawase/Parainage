@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-4">
                    <div class="page-title-content">
                        <h3>Filleuls</h3>
                        <p class="mb-2">Parrainez vos amis et recevez des commissions</p>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="breadcrumbs"><a href="affiliates.html#">Home </a>
                        <span><i class="fi fi-rr-angle-small-right"></i></span>
                        <a href="affiliates.html#">Acceuil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Votre pointage de crédit</h4>
            </div>
            <div class="card-body">
                <div class="credit-content">
                    <div class="invited d-flex justify-content-between">
                        <h6>Inviter</h6>
                        <h6 class="text-primary">{{$count}}</h6>
                    </div>
                    <div class="earnings d-flex justify-content-between">
                        <h6>Gains Potentiel</h6>
                        <h6 class="text-primary">$ {{$count*0.1}}</h6>
                    </div>
                    <button class="btn btn-primary">Obtenir vos récompenses</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liens de Parainage</h4>
            </div>
            <div class="card-body">
                <p>Gagnez 5% des Pièces que vos filleuls gagnent grâce à une offre ! Donnez-leur ce lien pour s'inscrire et c'est parti !</p>
                <div class="referral-form">
                    <form action="affiliates.html#">
                        <div class="form-row align-items-center">
                            <div class="mb-3 col-xl-8">
                                <label>Votre lien de parrainage</label>
                                <input type="text" class="form-control" placeholder="Votre lien de parrainage">
                                <div class="edit-copy">
                                    <span><i class="fi fi-rr-copy-alt"></i></span>
                                </div>
                            </div>
                            <div class="form-social col-xl-4">
                                {!!$partage!!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection