@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="page-container py-12">
    <section class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] items-center">
        <div class="space-y-6">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-brand">Contact Us</p>
            <h1 class="text-4xl font-bold text-slate-900 sm:text-5xl">We’re here to help you find the perfect style.</h1>
            <p class="max-w-2xl text-slate-600 text-lg leading-8">Whether you have a product question, need styling recommendations, or want to discuss a custom order, our support team is ready to assist.</p>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-brand/5 p-6 shadow-sm border border-brand/10">
                    <p class="text-sm uppercase tracking-[0.2em] font-semibold text-brand">Email</p>
                    <p class="mt-3 text-slate-900 font-semibold">support@hijabisplugg.com</p>
                </div>
                <div class="rounded-3xl bg-brand/5 p-6 shadow-sm border border-brand/10">
                    <p class="text-sm uppercase tracking-[0.2em] font-semibold text-brand">Phone</p>
                    <p class="mt-3 text-slate-900 font-semibold">+233 24 000 0000</p>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] overflow-hidden shadow-xl">
            <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80" alt="Contact support" class="h-full w-full object-cover min-h-[420px]">
        </div>
    </section>

    <section class="mt-16 grid gap-10 lg:grid-cols-2">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-10 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">About Our Team</h2>
            <p class="text-slate-600 leading-8 mb-6">Hijabis Plugg is built to celebrate modest fashion with confidence, comfort, and style. Our team combines thoughtful craftsmanship and modern design so you can dress with ease for every occasion.</p>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl bg-slate-50 p-5">
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Years in business</p>
                    <p class="mt-3 text-2xl font-semibold text-slate-900">5+</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-5">
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Happy customers</p>
                    <p class="mt-3 text-2xl font-semibold text-slate-900">12k+</p>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] bg-gradient-to-br from-brand/10 via-white to-slate-50 border border-brand/20 p-10 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Contact Information</h2>
            <div class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Head Office</p>
                    <p class="mt-3 text-slate-700">Plot 12, Tema Motorway, Accra, Ghana</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Customer Support</p>
                    <p class="mt-3 text-slate-700">support@hijabisplugg.com</p>
                    <p class="mt-1 text-slate-700">Mon - Fri, 9am - 6pm</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <p class="text-sm uppercase tracking-[0.18em] text-slate-500">Phone</p>
                    <p class="mt-3 text-slate-700">+233 24 000 0000</p>
                    <p class="mt-1 text-slate-700">Available on WhatsApp & Calls</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-16 bg-white border border-slate-200 rounded-[2rem] p-10 shadow-sm">
        <div class="grid gap-10 lg:grid-cols-[1.3fr_0.7fr] items-center">
            <div class="space-y-6">
                <p class="text-sm uppercase tracking-[0.24em] text-brand">Let’s start a conversation</p>
                <h2 class="text-3xl font-bold text-slate-900">Reach out for personalised styling or bulk orders.</h2>
                <p class="text-slate-600 leading-8">We respond quickly to every message and love helping customers find the right fit. Share your details and we’ll handle the rest.</p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-50 p-6">
                        <p class="text-slate-900 font-semibold">Fast replies</p>
                        <p class="text-sm text-slate-600 mt-2">We respond within 24 hours on weekdays.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-6">
                        <p class="text-slate-900 font-semibold">Secure orders</p>
                        <p class="text-sm text-slate-600 mt-2">Payments and personal data are protected.</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] bg-brand/5 p-8 shadow-inner text-slate-800">
                <div class="space-y-4">
                    <div>
                        <span class="text-sm uppercase tracking-[0.24em] text-brand">Customer care</span>
                        <h3 class="mt-2 text-2xl font-bold">Start a support request</h3>
                    </div>
                    <div class="rounded-3xl bg-white p-5 border border-slate-200">
                        <p class="font-semibold text-slate-900">Email</p>
                        <a href="mailto:support@hijabisplugg.com" class="block mt-2 text-brand hover:underline">support@hijabisplugg.com</a>
                    </div>
                    <div class="rounded-3xl bg-white p-5 border border-slate-200">
                        <p class="font-semibold text-slate-900">Call</p>
                        <a href="tel:+233240000000" class="block mt-2 text-brand hover:underline">+233 24 000 0000</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-16 grid gap-8 sm:grid-cols-3">
        <div class="rounded-3xl bg-brand text-white p-8 shadow-lg">
            <p class="text-sm uppercase tracking-[0.24em] text-brand/40">Trusted by customers</p>
            <h3 class="mt-4 text-3xl font-bold">12k+</h3>
            <p class="mt-3 text-slate-100">Satisfied customers across Ghana and beyond.</p>
        </div>
        <div class="rounded-3xl bg-slate-900 text-white p-8 shadow-lg">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Fast delivery</p>
            <h3 class="mt-4 text-3xl font-bold">Next-day shipping</h3>
            <p class="mt-3 text-slate-300">Speedy delivery for all in-stock essentials.</p>
        </div>
        <div class="rounded-3xl bg-slate-50 p-8 shadow-lg border border-slate-200">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Exclusive support</p>
            <h3 class="mt-4 text-3xl font-bold text-slate-900">Dedicated help</h3>
            <p class="mt-3 text-slate-600">Personal styling advice whenever you need it.</p>
        </div>
    </section>
</div>
@endsection