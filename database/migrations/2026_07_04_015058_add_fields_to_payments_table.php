use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->timestamp('payment_date')->nullable()->after('reference_number');

            $table->unsignedBigInteger('received_by')->nullable()->after('payment_date');

            $table->text('remarks')->nullable()->after('received_by');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_date',
                'received_by',
                'remarks',
            ]);
        });
    }
};
