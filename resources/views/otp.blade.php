<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp Verfication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .otp-container {
            width: 400px;
            height: 300px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .otp-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        input {
            width: 300px;
            height: 60px;
            margin: 0 5px;
            font-size: 24px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border 0.3s;
            display: block;
        }

        input:focus {
            border-color: #007bff;
        }

        .submit-btn {
            width: 100%;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;

        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>


    <div class="otp-container">
        @if (Session::has('status'))
            <div class="alert alert-info">
                {{ Session::get('status') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        @if (Session::has('resend'))
            <div class="alert alert-success">
                {{ Session::get('resend') }}
            </div>
        @endif


        @if (Session::has('timeout'))
            <div class="alert alert-warning">
                {{ Session::get('timeout') }}
            </div>
        @endif



        @if (Session::has('timeout'))
            <form action="{{ route('otp.resend') }}" method="post">
                @csrf
                <button class="submit-btn">Resend OTP</button>
            </form>
        @else
            <h1 class="mb-4">Enter OTP</h1>
            <form action="{{ route('otp.ver') }}" method="post">
                @csrf
                <input type="text" name="otp" placeholder="Enter Your OTP" />
                <span> @error('otp')
                        <div class="alert alert-info mt-1 text-center">
                            {{ $message }}

                        </div>
                    @enderror
                </span>
                <button class="submit-btn mt-3">Verify OTP</button>


                {{-- {{$otp->timezone('Asia/Kolkata')}} --}}

            </form>
        @endif
    </div>


    <script>
        const inputs = document.querySelectorAll('.otp-inputs input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length > 0 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && input.value === "" && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>

</body>

</html>
