<?php

namespace Diary\Transformers;

use App\Entry;
use League\Fractal\TransformerAbstract;

class EntryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'journal'
    ];

    public function transform(Entry $entry)
    {
        return [
            'id' => $entry->id,
            'title' => $entry->title,
            'content' => $entry->content,
            'date' => $entry->date,
            'created_at' => $entry->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $entry->updated_at->format('Y-m-d H:i:s'),
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/entries/'.$entry->id,
                ]
            ],
        ];
    }

    public function includeJournal(Entry $entry)
    {
        return $this->item($entry->journal, new JournalTransformer, 'journal');
    }
}