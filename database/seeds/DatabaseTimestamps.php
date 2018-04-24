<?php


trait DatabaseTimestamps
{
    public function timestamps(): array
    {
        return [
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];
    }
}