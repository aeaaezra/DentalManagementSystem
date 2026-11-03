@php
    $cashier = auth()->user();

    $photoUrl = $cashier->profile_picture
        ? asset('storage/' . $cashier->profile_picture)
        : 'https://ui-avatars.com/api/?name='
            . urlencode($cashier->name)
            . '&background=E91E63&color=ffffff&size=200';
@endphp

<style>
.profile-ui {
    color: #263047;
    font-family: inherit;
}
.profile-ui * { box-sizing: border-box; }

.profile-ui .profile-hero {
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 24px;
    padding: 30px;
    margin-bottom: 22px;
    border-radius: 24px;
    background: linear-gradient(120deg, #ffe1ee, #ffaad0 55%, #f75b9e);
}

.profile-ui .profile-hero:after {
    content: "✦";
    position: absolute;
    right: 35px;
    top: 8px;
    color: rgba(255,255,255,.65);
    font-size: 100px;
    pointer-events: none;
}

.profile-ui .profile-avatar-wrap {
    position: relative;
    z-index: 1;
    flex-shrink: 0;
}

.profile-ui .profile-avatar {
    width: 118px;
    height: 118px;
    border: 5px solid white;
    border-radius: 50%;
    object-fit: cover;
    background: white;
    box-shadow: 0 8px 25px #bd347344;
}

.profile-ui .profile-hero-info {
    position: relative;
    z-index: 1;
    min-width: 180px;
}

.profile-ui .profile-eyebrow {
    margin-bottom: 7px;
    color: #9b315f;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.profile-ui .profile-name {
    margin: 0;
    color: #41213a;
    font-size: clamp(24px, 3vw, 32px);
    font-weight: 800;
    line-height: 1.2;
    overflow-wrap: anywhere;
}

.profile-ui .profile-email {
    margin-top: 9px;
    color: #79415e;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.profile-ui .profile-role {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 13px;
    padding: 7px 12px;
    border: 1px solid #ffffffb8;
    border-radius: 20px;
    background: #ffffffb8;
    color: #bd276b;
    font-size: 11px;
    font-weight: 800;
}

.profile-ui .profile-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.5fr) minmax(250px, .85fr);
    gap: 20px;
}

.profile-ui .profile-card {
    min-width: 0;
    padding: 25px;
    border: 1px solid #f5dfeb;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 5px 22px #74304c08;
}

.profile-ui .profile-card-title {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 18px;
    margin-bottom: 22px;
    border-bottom: 1px solid #f2edf0;
}

.profile-ui .profile-icon {
    display: grid;
    place-items: center;
    flex-shrink: 0;
    width: 45px;
    height: 45px;
    border-radius: 14px;
    background: #ffe8f2;
    color: #e92d81;
    font-size: 21px;
}

.profile-ui .profile-card-title h3 {
    margin: 0;
    color: #273047;
    font-size: 17px;
    font-weight: 800;
}

.profile-ui .profile-subtitle {
    margin-top: 5px;
    color: #9299aa;
    font-size: 12px;
}

.profile-ui .profile-details {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.profile-ui .profile-detail-label {
    display: block;
    margin-bottom: 8px;
    color: #737c90;
    font-size: 12px;
    font-weight: 700;
}

.profile-ui .profile-detail-value {
    min-height: 47px;
    display: flex;
    align-items: center;
    padding: 12px;
    border: 1px solid #ececf2;
    border-radius: 12px;
    background: #fafafd;
    color: #303950;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.profile-ui .profile-photo-preview {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 22px 15px;
    border: 1.5px dashed #f2a4c7;
    border-radius: 16px;
    background: #fff8fb;
    text-align: center;
}

.profile-ui .profile-mini-avatar {
    width: 76px;
    height: 76px;
    margin-bottom: 12px;
    border: 4px solid white;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 3px 14px #9c41651c;
}

.profile-ui .profile-photo-caption {
    color: #424b61;
    font-size: 13px;
    font-weight: 700;
}

.profile-ui .profile-photo-hint {
    margin-top: 6px;
    color: #969bad;
    font-size: 11px;
    line-height: 1.6;
}

.profile-ui .profile-info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-top: 16px;
    padding: 15px;
    border: 1px solid #f5e5ed;
    border-radius: 15px;
    background: #fffafd;
}

.profile-ui .profile-info-row strong {
    color: #394157;
    font-size: 12px;
}

.profile-ui .profile-info-row p {
    margin-top: 4px;
    color: #8b92a3;
    font-size: 11px;
    line-height: 1.7;
}

@media (max-width: 800px) {
    .profile-ui .profile-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 500px) {
    .profile-ui .profile-hero { padding: 20px; gap: 16px; }
    .profile-ui .profile-avatar { width: 88px; height: 88px; }
    .profile-ui .profile-card { padding: 17px; }
    .profile-ui .profile-details { grid-template-columns: 1fr; gap: 14px; }
}
</style>

<div class="profile-ui">

    <div class="profile-hero">
        <div class="profile-avatar-wrap">
            <img
                class="profile-avatar"
                src="{{ $photoUrl }}"
                alt="Profile photo"
            >
        </div>

        <div class="profile-hero-info">
            <div class="profile-eyebrow">Shine & Smile Dental POS</div>

            <h2 class="profile-name">{{ $cashier->name }}</h2>

            <p class="profile-email">{{ $cashier->email }}</p>

            <span class="profile-role">
                <span>●</span>
                {{ ucfirst($cashier->role ?? 'Cashier') }} Account
            </span>
        </div>
    </div>

    <div class="profile-grid">

        <section class="profile-card">
            <div class="profile-card-title">
                <div class="profile-icon">♙</div>
                <div>
                    <h3>Personal Information</h3>
                    <p class="profile-subtitle">
                        Your account information at a glance
                    </p>
                </div>
            </div>

            <div class="profile-details">
                <div>
                    <span class="profile-detail-label">Full Name</span>
                    <div class="profile-detail-value">
                        {{ $cashier->name }}
                    </div>
                </div>

                <div>
                    <span class="profile-detail-label">Email Address</span>
                    <div class="profile-detail-value">
                        {{ $cashier->email }}
                    </div>
                </div>

                <div>
                    <span class="profile-detail-label">Account Role</span>
                    <div class="profile-detail-value">
                        {{ ucfirst($cashier->role ?? 'Cashier') }}
                    </div>
                </div>

                <div>
                    <span class="profile-detail-label">Phone Number</span>
                    <div class="profile-detail-value">
                        {{ $cashier->phone ?? 'Not provided' }}
                    </div>
                </div>
            </div>
        </section>

        <aside>
            <section class="profile-card">
                <div class="profile-card-title">
                    <div class="profile-icon">♡</div>
                    <div>
                        <h3>Profile Appearance</h3>
                        <p class="profile-subtitle">
                            Your current account picture
                        </p>
                    </div>
                </div>

                <div class="profile-photo-preview">
                    <img
                        class="profile-mini-avatar"
                        src="{{ $photoUrl }}"
                        alt="Current profile photo"
                    >

                    <div class="profile-photo-caption">
                        {{ $cashier->name }}
                    </div>

                    <div class="profile-photo-hint">
                        Your profile picture is displayed<br>
                        throughout your account.
                    </div>
                </div>
            </section>

            <div class="profile-info-row">
                <div class="profile-icon">✓</div>
                <div>
                    <strong>Account Overview</strong>
                    <p>
                        You are viewing the profile associated with
                        your current signed-in account.
                    </p>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-icon">✦</div>
                <div>
                    <strong>Shine with Confidence</strong>
                    <p>
                        Keep your account details clear and
                        recognizable for your daily POS activities.
                    </p>
                </div>
            </div>
        </aside>

    </div>
</div>
