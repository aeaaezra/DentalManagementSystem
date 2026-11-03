@php
    $senderInitial = strtoupper(mb_substr($contact->name ?? '?', 0, 1));
@endphp

<div class="ss-contact-detail">
    <style>
        .ss-contact-detail {
            color: #e5e7eb;
            font-size: 13px;
        }

        .ss-contact-detail * {
            box-sizing: border-box;
        }

        .ss-contact-detail .ss-contact-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 17px;
            margin-bottom: 18px;
            border: 1px solid rgba(148, 163, 184, .18);
            border-radius: 14px;
            background: linear-gradient(135deg, #172033, #101827);
        }

        .ss-contact-detail .ss-contact-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fce7f3;
            color: #be185d;
            font-size: 18px;
            font-weight: 800;
        }

        .ss-contact-detail .ss-contact-title {
            margin: 0 0 4px;
            color: #f9fafb;
            font-size: 16px;
            font-weight: 750;
            overflow-wrap: anywhere;
        }

        .ss-contact-detail .ss-contact-subtitle {
            color: #9ca3af;
            font-size: 12px;
        }

        .ss-contact-detail .ss-contact-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .ss-contact-detail .ss-contact-field {
            min-width: 0;
            padding: 14px;
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 11px;
            background: rgba(15, 23, 42, .65);
        }

        .ss-contact-detail .ss-contact-label {
            display: block;
            margin-bottom: 7px;
            color: #9ca3af;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .ss-contact-detail .ss-contact-value {
            margin: 0;
            color: #f3f4f6;
            line-height: 1.6;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .ss-contact-detail .ss-contact-value a {
            color: #f9a8d4;
            text-decoration: none;
        }

        .ss-contact-detail .ss-contact-value a:hover {
            text-decoration: underline;
        }

        .ss-contact-detail .ss-contact-message {
            padding: 17px;
            border: 1px solid rgba(148, 163, 184, .2);
            border-radius: 12px;
            background: rgba(15, 23, 42, .72);
        }

        .ss-contact-detail .ss-contact-message-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 12px;
            color: #f9fafb;
            font-size: 13px;
            font-weight: 750;
        }

        .ss-contact-detail .ss-contact-message-body {
            min-height: 100px;
            max-height: 340px;
            overflow-y: auto;
            padding: 14px;
            border-radius: 9px;
            background: rgba(2, 6, 23, .55);
            color: #d1d5db;
            line-height: 1.8;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        @media (max-width: 520px) {
            .ss-contact-detail .ss-contact-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }
    </style>

    <div class="ss-contact-header">
        <div class="ss-contact-avatar" aria-hidden="true">
            {{ $senderInitial }}
        </div>

        <div style="min-width: 0;">
            <h3 class="ss-contact-title">
                {{ $contact->name ?: 'Unknown sender' }}
            </h3>
            <div class="ss-contact-subtitle">
                Contact message details
            </div>
        </div>
    </div>

    <div class="ss-contact-grid">
        <div class="ss-contact-field">
            <span class="ss-contact-label">Sender name</span>
            <p class="ss-contact-value">
                {{ $contact->name ?: 'Not provided' }}
            </p>
        </div>

        <div class="ss-contact-field">
            <span class="ss-contact-label">Email address</span>
            <p class="ss-contact-value">
                @if ($contact->email)
                    <a href="mailto:{{ $contact->email }}">
                        {{ $contact->email }}
                    </a>
                @else
                    Not provided
                @endif
            </p>
        </div>

        <div class="ss-contact-field">
            <span class="ss-contact-label">Subject</span>
            <p class="ss-contact-value">
                {{ $contact->subject ?: 'No subject' }}
            </p>
        </div>

        <div class="ss-contact-field">
            <span class="ss-contact-label">Date received</span>
            <p class="ss-contact-value">
                {{ $contact->created_at?->format('M d, Y') ?? 'Unknown' }}
                @if ($contact->created_at)
                    <span style="display:block;color:#9ca3af;font-size:12px;">
                        {{ $contact->created_at->format('h:i A') }}
                    </span>
                @endif
            </p>
        </div>
    </div>

    <section class="ss-contact-message">
        <h4 class="ss-contact-message-heading">
            <span aria-hidden="true">✉</span>
            Message
        </h4>

        <div class="ss-contact-message-body">{{ $contact->message ?: 'No message content.' }}</div>
    </section>
</div>
