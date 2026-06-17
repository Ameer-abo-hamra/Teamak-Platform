@extends('layout.master')

@section('title', 'Employee Invitation')

@section('header', 'You are invited')

@section('content')

    <h3>Hello 👋</h3>

    <p>You have been invited to join our system.</p>

    <p><strong>Company:</strong> {{ $company }}</p>
    <p><strong>Department:</strong> {{ $department }}</p>
    <p><strong>Job Title:</strong> {{ $job_title }}</p>
    @if (!empty($description))
        <div
            style="
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        line-height: 1.6;
        margin-bottom : 20px ; 
    ">
            <strong style="display:block; margin-bottom:8px; color:#111827;">
                Invitation Message:
            </strong>

            <p style="margin:0;">
                {{ $description }}
            </p>
        </div>
    @endif
    <a href="{{ $link }}"
        style="display:inline-block;
          padding:12px 20px;
          background:#2563eb;
          color:#fff;
          text-decoration:none;
          border-radius:6px;
          font-weight:bold;">
        Accept Invitation
    </a>

@endsection
