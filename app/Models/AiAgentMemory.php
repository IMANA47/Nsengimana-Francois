<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AiAgentMemory extends Model
{
    protected $fillable = [
        'category',
        'key',
        'data',
        'priority',
        'active'
    ];

    protected $casts = [
        'data' => 'array',
        'active' => 'boolean',
        'priority' => 'integer'
    ];

    // Scopes for efficient querying
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeByPriority(Builder $query): Builder
    {
        return $query->orderBy('priority', 'desc');
    }

    // Helper methods
    public static function getSkills(): array
    {
        return self::active()
            ->byCategory('skills')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    public static function getProjects(): array
    {
        return self::active()
            ->byCategory('projects')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    public static function getExperience(): array
    {
        return self::active()
            ->byCategory('experience')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    public static function getProfile(): array
    {
        return self::active()
            ->byCategory('profile')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    public static function getServices(): array
    {
        return self::active()
            ->byCategory('services')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    public static function getCertifications(): array
    {
        return self::active()
            ->byCategory('certifications')
            ->byPriority()
            ->pluck('data', 'key')
            ->toArray();
    }

    // Update or create memory entry
    public static function updateMemory(string $category, string $key, array $data, int $priority = 1): self
    {
        try {
            return self::updateOrCreate(
                ['category' => $category, 'key' => $key],
                ['data' => $data, 'priority' => $priority, 'active' => true]
            );
        } catch (\Exception $e) {
            // If table doesn't exist, create it first
            if (str_contains($e->getMessage(), "doesn't exist")) {
                // Table might not exist yet, return a mock object
                return new self([
                    'category' => $category,
                    'key' => $key,
                    'data' => $data,
                    'priority' => $priority,
                    'active' => true
                ]);
            }
            throw $e;
        }
    }

    // Search across all categories
    public static function search(string $query): array
    {
        $results = [];
        
        self::active()
            ->where(function ($q) use ($query) {
                $q->where('key', 'like', "%{$query}%")
                  ->orWhereJsonContains('data', $query);
            })
            ->get()
            ->each(function ($item) use (&$results) {
                $results[$item->category][$item->key] = $item->data;
            });

        return $results;
    }
}
