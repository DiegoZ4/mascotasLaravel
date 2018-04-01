@extends('admin.template.main')

@section('title', 'Login')

@section('body')
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Login</div>
            </div>
            <div class="card-body">
                @include('admin.template.partials.errors')
                
                {!! Form::open(['route' => 'admin.auth.login', 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('email', 'Correo Electrónico') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@mail.com']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Contraseña') !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '***********']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::submit('Ingresar', ['class' => 'btn btn-info']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@endsection