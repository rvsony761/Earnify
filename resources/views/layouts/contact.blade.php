@extends('layouts.app')

@section('title', 'Contact Us - Earning Platform')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-16 px-4">
    <div class="max-w-lg w-full bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-primary-600 text-center mb-6">Contact Us</h2>

        {{-- @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif --}}

        <form action="{{ route('contact.sendmail') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" placeholder="Your Name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
                @error('name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="Your Email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required>
                @error('email') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" rows="4" placeholder="Write your message..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-600" required></textarea>
                @error('message') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <button type="submit"
                class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection
