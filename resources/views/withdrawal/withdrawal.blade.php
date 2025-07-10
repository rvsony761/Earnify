{{--@extends('layouts.app')

@section('title', 'Withdraw Earnings')

@section('content')
<div class="py-12 max-w-md mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-primary-600 mb-6 text-center">Withdraw Your Earnings</h1>
        
        <form action="{{ route('withdrawal.store') }}" method="post">
            @csrf
            
            <div class="mb-6">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Amount to Withdraw (₹)</label>
                <input type="number" id="amount" name="amount" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600"
                       placeholder="Minimum ₹100" 
                       min="100" step="1" required>
               <p class="text-sm text-gray-500 mt-1">Available balance: ₹{{ auth()->user()->balance ?? 0 }}</p>
            </div>
            
            <div class="mb-6">
                <label for="method" class="block text-gray-700 font-medium mb-2">Payment Method</label>
                <select id="method" name="method" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600" required>
                    <option value="">Select payment method</option>
                    <option value="upi">UPI</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            
            <div id="upi-details" class="mb-6 hidden">
                <label for="upi_id" class="block text-gray-700 font-medium mb-2">UPI ID</label>
                <input type="text" id="upi_id" name="upi_id" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600"
                       placeholder="yourname@upi">
            </div>
            
            <div id="bank-details" class="mb-6 hidden">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="account_number" class="block text-gray-700 font-medium mb-2">Account Number</label>
                        <input type="text" id="account_number" name="account_number" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600">
                    </div>
                    <div>
                        <label for="ifsc" class="block text-gray-700 font-medium mb-2">IFSC Code</label>
                        <input type="text" id="ifsc" name="ifsc" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600">
                    </div>
                </div>
                <div>
                    <label for="account_name" class="block text-gray-700 font-medium mb-2">Account Holder Name</label>
                    <input type="text" id="account_name" name="account_name" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600">
                </div>
            </div>
            
            <button type="submit" 
                    class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg hover:bg-primary-700 transition font-medium">
                Request Withdrawal
            </button>
        </form>
    </div>
    
    {{--<div class="mt-8 bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold text-primary-600 mb-4">Withdrawal History</h2>
        <div class="space-y-4">
            @forelse($withdrawals as $withdrawal)
                <div class="border-b pb-3">
                    <div class="flex justify-between">
                        <span class="font-medium">₹{{ $withdrawal->amount }}</span>
                        <span class="text-sm {{ $withdrawal->status == 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $withdrawal->method }} • {{ $withdrawal->created_at->format('d M Y') }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">No withdrawal history yet</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.getElementById('method').addEventListener('change', function() {
        document.getElementById('upi-details').classList.add('hidden');
        document.getElementById('bank-details').classList.add('hidden');
        
        if(this.value === 'upi') {
            document.getElementById('upi-details').classList.remove('hidden');
        } else if(this.value === 'bank') {
            document.getElementById('bank-details').classList.remove('hidden');
        }
    });
</script>
@endsection
--}}
@extends('layouts.app')

@section('title', 'Withdraw Earnings')

@section('content')
<div class="py-12 max-w-md mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-primary-600 mb-6 text-center">Withdraw Your Earnings</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('withdrawal.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="amount" class="block text-gray-700 font-medium mb-2">Amount to Withdraw (₹)</label>
                <input type="number" id="amount" name="amount" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600"
                       placeholder="Minimum ₹50" 
                       min="50" required>
                <p class="text-sm text-gray-500 mt-1">Available balance: ₹{{ auth()->user()->earnings ?? 0 }}</p>
            </div>
            
            <div class="mb-6">
                <label for="payment_method" class="block text-gray-700 font-medium mb-2">Payment Method</label>
                <select id="payment_method" name="payment_method" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600" required>
                    <option value="">Select payment method</option>
                    <option value="upi">UPI</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label for="payment_detail" class="block text-gray-700 font-medium mb-2">Payment Details</label>
                <input type="text" id="payment_detail" name="payment_detail" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-600 focus:border-primary-600"
                       placeholder="Enter UPI ID or account details" required>
            </div>
            
            <button type="submit" 
                    class="w-full bg-primary-600 text-white py-3 px-4 rounded-lg hover:bg-primary-700 transition font-medium">
                Request Withdrawal
            </button>
        </form>
    </div>
</div>
@endsection