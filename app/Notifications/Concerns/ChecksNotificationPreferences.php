<?php

namespace App\Notifications\Concerns;

trait ChecksNotificationPreferences
{
    // ============================================================
    // CHECK APPOINTMENT NOTIFICATIONS
    // ============================================================

    protected function appointmentNotificationsEnabled(
        object $notifiable
    ): bool {
        // If the user does not have dentist settings,
        // allow notifications normally.
        if (
            !method_exists(
                $notifiable,
                'dentistSetting'
            )
        ) {
            return true;
        }

        // Get dentist notification settings.
        $settings = $notifiable->dentistSetting;

        // If no settings exist,
        // allow notifications by default.
        if (!$settings) {
            return true;
        }

        // Check appointment notification preference.
        return (bool) (
            $settings->appointment_notifications ?? true
        );
    }

    // ============================================================
    // CHECK TREATMENT NOTIFICATIONS
    // ============================================================

    protected function treatmentNotificationsEnabled(
        object $notifiable
    ): bool {
        // If the user does not have dentist settings,
        // allow notifications normally.
        if (
            !method_exists(
                $notifiable,
                'dentistSetting'
            )
        ) {
            return true;
        }

        // Get dentist notification settings.
        $settings = $notifiable->dentistSetting;

        // If no settings exist,
        // allow notifications by default.
        if (!$settings) {
            return true;
        }

        // Check treatment notification preference.
        return (bool) (
            $settings->treatment_notifications ?? true
        );
    }

    // ============================================================
    // CHECK SYSTEM NOTIFICATIONS
    // ============================================================

    protected function systemNotificationsEnabled(
        object $notifiable
    ): bool {
        // If the user does not have dentist settings,
        // allow notifications normally.
        if (
            !method_exists(
                $notifiable,
                'dentistSetting'
            )
        ) {
            return true;
        }

        // Get dentist notification settings.
        $settings = $notifiable->dentistSetting;

        // If no settings exist,
        // allow notifications by default.
        if (!$settings) {
            return true;
        }

        // Check system notification preference.
        return (bool) (
            $settings->system_notifications ?? true
        );
    }
}
