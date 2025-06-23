<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatbots'; // This tells Laravel to use the 'chatbots' table

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Specify 'id' as the primary key

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // Set to false because your 'id' is VARCHAR and not auto-incrementing

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string'; // Specify key type as string for VARCHAR ID

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',          // ID is now fillable since it's not auto-incrementing
        'user_id',
        'name',
        'description',
        'data_sources', // Make sure to cast this if you want it as array/object
        'llm_type',
        'openai_api_key',
        'is_ready',
        'embed_url',
        'status_message',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_sources' => 'array', // Cast 'data_sources' to an array
        'is_ready' => 'boolean',   // Cast 'is_ready' to a boolean
        'created_at' => 'datetime',
        'last_updated' => 'datetime', // Laravel will handle 'updated_at' automatically if you just use 'timestamps'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'openai_api_key', // Hide sensitive API keys when converting to array/JSON
    ];

    // If your table uses `created_at` and `last_updated` instead of `created_at` and `updated_at`
    // You'll need to define custom timestamp column names
    const UPDATED_AT = 'last_updated';

    /**
     * Get the user that owns the chatbot.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid'); // Assuming users table has 'uid' as primary key
    }
}