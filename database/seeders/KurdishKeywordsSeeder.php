<?php

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KurdishKeywordsSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('database/seeders/Kurdish Liberay AI_22.7.25.json');
        if (!file_exists($jsonPath)) {
            $this->command?->warn('Kurdish keywords JSON not found: ' . $jsonPath);
            return;
        }

        $raw = file_get_contents($jsonPath);
        if ($raw === false) {
            $this->command?->warn('Unable to read Kurdish keywords JSON.');
            return;
        }

        // Normalize encoding and remove BOM
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);

        $decoded = json_decode($raw, true);

        $keywords = [];

        if (is_array($decoded)) {
            $keywords = $this->extractKeywordsFromArray($decoded);
        } else {
            // Fallback: treat as newline-delimited text
            $lines = preg_split("/(\r\n|\r|\n)+/", $raw) ?: [];
            foreach ($lines as $line) {
                $token = trim($line);
                if ($token !== '') {
                    $keywords[] = $token;
                }
            }
        }

        // Deduplicate and normalize
        $keywords = array_values(array_unique(array_map(function ($word) {
            $word = trim((string) $word);
            // Collapse internal whitespace
            $word = preg_replace('/\s+/', ' ', $word);
            return $word;
        }, $keywords)));

        // Filter empties after normalization
        $keywords = array_values(array_filter($keywords, fn ($w) => $w !== ''));

        if (empty($keywords)) {
            $this->command?->warn('No keywords parsed from Kurdish JSON.');
            return;
        }

        // Upsert in chunks to avoid memory spikes
        $chunks = array_chunk($keywords, 500);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $word) {
                Keyword::updateOrCreate(
                    ['name' => $word],
                    ['language' => 'ku']
                );
            }
        }

        $this->command?->info('Imported ' . count($keywords) . ' Kurdish keywords.');
    }

    private function extractKeywordsFromArray(array $data): array
    {
        $result = [];

        if (array_is_list($data)) {
            foreach ($data as $item) {
                if (is_string($item)) {
                    $result[] = $item;
                } elseif (is_array($item)) {
                    if (isset($item['keyword']) && is_string($item['keyword'])) {
                        $result[] = $item['keyword'];
                    } elseif (isset($item['name']) && is_string($item['name'])) {
                        $result[] = $item['name'];
                    } else {
                        // Pick first scalar value if present
                        foreach ($item as $value) {
                            if (is_string($value)) {
                                $result[] = $value;
                                break;
                            }
                        }
                    }
                }
            }
        } else {
            // Associative array: keys may be the words or values may be arrays/strings
            foreach ($data as $key => $value) {
                if (is_string($key)) {
                    $trimmedKey = trim($key);
                    if ($trimmedKey !== '') {
                        $result[] = $trimmedKey;
                    }
                }

                if (is_string($value)) {
                    $trimmedVal = trim($value);
                    if ($trimmedVal !== '') {
                        $result[] = $trimmedVal;
                    }
                } elseif (is_array($value)) {
                    foreach ($this->extractKeywordsFromArray($value) as $nested) {
                        $result[] = $nested;
                    }
                }
            }
        }

        return $result;
    }
}

