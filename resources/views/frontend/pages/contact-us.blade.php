@extends('frontend.layout.app')

@push('css')


@endpush
@section('content')
    <div class="bannerContact">
        <div class="container">
            <div class="text-center">
                <div class="heading">
                    <h2 class="sectionHeading">Con<span>tac</span>t Us</h2>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 contactLeft">
                <h4>Get in touch with us</h4>
                <h5>Using our contact details or alternatively feel free to fill our form given below</h5>
                <div class="row contactRow">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <address>For {{ $settings[0]->name }}: <span>Call us: {{ $settings[0]->value }}</span></address>
                    </div>
                </div>
                <div class="row contactRow">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <address>For {{ $settings[1]->name }}: <span>{{ $settings[1]->value }}</span></address>
                    </div>
                </div>
                <div class="row contactRow">
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                        <address>{{ $settings[2]->name }} <span>{{ $settings[2]->value }}</span>
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12 bannerFields">
                <form method="post" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="full_name">Full Name<span>*</span></label>
                                <input id="full_name" type="text"
                                       class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                       value="{{ old('full_name') }}" autocomplete="full_name">

                                @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email<span>*</span></label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="nature_of_contact">Nature of Contact <span>*</span> </label>
                                <select id="nature_of_contact"
                                        class="form-control cities @error('nature_of_contact') is-invalid @enderror"
                                        name="nature_of_contact" autocomplete="nature_of_contact">
                                    <option value="">Select an option</option>
                                    <option
                                        value="Suggestion" {{ (old('nature_of_contact') == 'Suggestion') ? 'selected' : ''}}>
                                        Suggestion
                                    </option>
                                    <option
                                        value="Bug Report" {{ (old('nature_of_contact') == 'Bug Report') ? 'selected' : ''}}>
                                        Bug Report
                                    </option>
                                    <option
                                        value="Complaint" {{ (old('nature_of_contact') == 'Complaint') ? 'selected' : ''}}>
                                        Complaint
                                    </option>
                                    <option
                                        value="Feature Request" {{ (old('nature_of_contact') == 'Feature Request') ? 'selected' : ''}}>
                                        Feature Request
                                    </option>
                                    <option
                                        value="Other" {{ (old('nature_of_contact') == 'Other') ? 'selected' : ''}}>
                                        Other
                                    </option>
                                </select>

                                @error('nature_of_contact')
                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="subject">Subject <span>*</span></label>
                                <input id="subject" type="text"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       name="subject" value="{{ old('subject') }}" autocomplete="subject">

                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="message">Your Message <span>*</span></label>
                                <textarea id="message"
                                          class="form-control @error('message') is-invalid @enderror"
                                          name="message" rows="7"
                                          autocomplete="message">{{ old('message') }}</textarea>

                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn buttonMain hvr-bounce-to-right">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush

