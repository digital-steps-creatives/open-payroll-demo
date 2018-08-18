@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Deduction') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('deduction.store', ['payslip' => request()->hashslug]) }}" aria-label="{{ __('Create New Deduction') }}">
                        @csrf
                        <input type="hidden" name="payslip" id="payslip" value="{{ request()->hashslug }}">
                        <div class="form-group">
                            <label for="payroll">{{ __('Choose Deduction Type:') }}</label>
                            <select name="payroll" id="payroll" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">{{ __('Amount:') }}</label>
                            
                            <input id="amount" type="number" 
                                class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" 
                                name="amount" value="{{ old('amount') }}" 
                                required autofocus>

                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create New Deduction') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection