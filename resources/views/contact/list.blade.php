@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')

<style>

body {
    background: radial-gradient(circle at top left, #0f0c29, #302b63, #24243e);
    font-family: 'Poppins', sans-serif;
    color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.structure {
    max-width: 1000px;
    margin: 4rem auto;
    padding: 2rem;
}

.admin-contacts {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2.5rem 3rem;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
    animation: fadeIn 0.8s ease-in-out;
}

a {
    text-decoration: underline;
    color: white;
}

.message-date {
    margin-bottom: 1rem;
    padding: 0.5rem 1rem;
    background: rgba(0, 229, 255, 0.08);
    border-left: 4px solid #00e5ff;
    border-radius: 8px;
    font-size: 0.95rem;
    color: #e0f7fa;
    box-shadow: inset 0 0 8px rgba(0, 229, 255, 0.2);
    display: inline-block;
    text-shadow: 0 0 2px #00e5ff88;
}

.message-date i,
.message-date .icon-calendar {
    color: #00e5ff;
    flex-shrink: 0;
    width: 18px;
    height: 18px;
}

.message-date strong {
    color: #80d8ff;
    margin-right: 6px;
}


.admin-contacts h1 {
    font-size: 2.8rem;
    text-align: center;
    margin-bottom: 2.5rem;
    color: #00e5ff;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 0.8rem;
    letter-spacing: 2px;
    text-shadow: 0 0 5px #00e5ff88;
}

.admin-contacts ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.admin-contacts li {
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 15px;
    padding: 1.7rem 2rem;
    margin-bottom: 1.8rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    box-shadow: 0 0 12px rgba(0, 229, 255, 0.05);
}

.admin-contacts li:hover {
    transform: scale(1.02);
    box-shadow: 0 0 15px rgba(0, 229, 255, 0.25);
    background: rgba(255, 255, 255, 0.09);
}

.admin-contacts p {
    margin: 0.5rem 0;
    font-size: 1rem;
    line-height: 1.8;
}

.admin-contacts strong {
    color: #80d8ff;
    font-weight: 600;
}

.admin-contacts em {
    font-style: normal;
}

.admin-contacts hr {
    border: none;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
    margin-top: 1.2rem;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media screen and (max-width: 600px) {

    .admin-contacts,
    .admin-contacts li {
     padding: 10px;
    }
}

</style>
    <div class="structure m-auto">
        <div class="admin-contacts">
            <h1>Contact Messages</h1>
            @if($contacts->isEmpty())
                <p>No messages found.</p>
            @else
                <ul>
                    @foreach ($contacts as $contact)
                        <li>
                            <div class="message-date">
                                <i class="fas fa-calendar-alt"></i>
                                <strong>Date:</strong> {{ \Carbon\Carbon::parse($contact->created_at)->format('F j, Y H:i') }}
                            </div>
                            <p><strong>Name:</strong> {{ $contact->name }}</p>
                            <p><strong>Email:</strong><a href="mailto:{{ $contact->email }}"> {{ $contact->email }}</a></p>
                            <p><strong>Phone:</strong> <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                            <p><strong>Message:</strong> {{ $contact->message }}</p>
                            <hr>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="pagination">
              {{ $contacts->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection
