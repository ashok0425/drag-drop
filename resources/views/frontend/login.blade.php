@extends('frontend.layouts.master')
@section('content')
    <div class="container mt5 pt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="card-title">Login</div>
                    </div>
                    <div class="card-body">
                        <div class="alert-danger alert d-none">

                        </div>
                        <form action="{{ url('api/login') }}" method="POST">

                            <div class="form-group my-2">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    placeholder="Enter email" name="email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                    else.</small>
                            </div>
                            <div class="form-group my-2">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    name="password" minlength="8" required>
                            </div>


                            <button type="button" class="btn btn-primary submit_btn" name="submit"
                                value="submit">Submit</button>
                        </form </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script>
            // redirect if login 
            if (sessionStorage.getItem('token')) {
                location.href = '/'
            }
            let form = document.querySelector('form');
            let submit_btn = document.querySelector('.submit_btn');
            let alert = document.querySelector('.alert');

            submit_btn.addEventListener('click', (e) => {
                e.preventDefault();

                url = form.getAttribute('action');
                let data = {};
                let inputs = Array.from(form.elements);
                // getting all input value 
                inputs.forEach(input => {
                    if (input.value == '') {
                        alert(`${[input.name]} is required field`)
                        return false;
                    }
                    data = {
                        ...data,
                        [input.name]: input.value
                    }
                });
                login(url, data)
            })


            //   send post request 
            async function login(url, data) {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                });
                let res = await response.json();
                if (res.status == 'error') {
                    alert.classList.remove('d-none')
                    alert.classList.add('d-block')
                    alert.innerHTML = res.message;
                    return false;
                } else {
                    alert.classList.remove('d-none', 'alert-danger')
                    alert.classList.add('d-block', 'alert-success')
                    alert.innerHTML = res.message;
                    sessionStorage.setItem('token', res.data)
                    location.href = '/'
                }


            }
        </script>
    @endpush
