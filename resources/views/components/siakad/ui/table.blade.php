@props(['headers' => []])

<div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #e2e8f0; margin-top: 15px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th style="background: #f0fdf4; padding: 12px 16px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7;">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>

<style>
    /* CSS Scoped to Table */
    table tbody tr:hover { background: #f8fafc; }
    table tbody td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; color: #475569; vertical-align: middle; }
</style>

