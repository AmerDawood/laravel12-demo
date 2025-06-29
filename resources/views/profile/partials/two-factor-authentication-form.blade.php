{{-- <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            التحقق بخطوتين
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            أضف طبقة حماية إضافية لحسابك باستخدام التحقق بخطوتين.
        </p>
    </header>

    @if (! auth()->user()->two_factor_secret)
        <form method="POST" action="{{ route('two-factor.enable') }}">
            @csrf

            <x-primary-button>
                تفعيل التحقق بخطوتين
            </x-primary-button>
        </form>
    @else
        <div>
            <p class="text-sm text-green-600 dark:text-green-400">
                تم تفعيل التحقق بخطوتين لهذا الحساب.
            </p>

            <div class="mt-4">
                <p class="text-sm font-semibold">امسح كود QR باستخدام تطبيق المصادقة:</p>
                <div class="mt-2">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm font-semibold">أكواد الاستعادة (احتفظ بها في مكان آمن):</p>
                <ul class="mt-2 list-disc list-inside text-sm text-gray-600 dark:text-gray-400">
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                        <li>{{ $code }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <form method="POST" action="{{ route('two-factor.disable') }}" class="mt-4">
            @csrf
            @method('DELETE')

            <x-danger-button>
                تعطيل التحقق بخطوتين
            </x-danger-button>
        </form>
    @endif
</section> --}}
