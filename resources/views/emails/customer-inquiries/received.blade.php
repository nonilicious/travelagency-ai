<h1>New travel request</h1>

<p><strong>Name:</strong> {{ $inquiry->name }}</p>
<p><strong>Email:</strong> {{ $inquiry->email }}</p>
<p><strong>Phone:</strong> {{ $inquiry->phone ?: '-' }}</p>
<p><strong>Destination:</strong> {{ $inquiry->destination_interest ?: '-' }}</p>
<p><strong>Travelers:</strong> {{ $inquiry->travelers }}</p>
<p><strong>Dates:</strong> {{ optional($inquiry->preferred_start_date)->format('d.m.Y') ?: '-' }} - {{ optional($inquiry->preferred_end_date)->format('d.m.Y') ?: '-' }}</p>
<p><strong>Budget:</strong> {{ $inquiry->budget ? number_format((float) $inquiry->budget, 0, ',', '.') .' EUR' : '-' }}</p>

<h2>Message</h2>
<p>{{ $inquiry->message }}</p>
