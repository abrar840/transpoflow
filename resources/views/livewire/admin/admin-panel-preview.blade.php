


<div class="demo-preview-container">
    <style>

.preview-placeholder i.fa-spinner {
    font-size: 2rem;
    color: #4f46e5;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

        .demo-preview-container {
            height:90vh;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-width:1800px;
            margin: 40px auto;
            background: #f8fafc;
            border-radius: 16px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.07);
            overflow: hidden;
        }
        .demo-description {
            width:50px;
            flex: 1 1 100px;
            padding: 3rem 2rem;
            background: linear-gradient(135deg, hsl(245, 33%, 8%) 0%, #000000 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .demo-description h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }
        .demo-description p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .feature-list {
            margin-bottom: 2rem;
            padding-left: 0;
            list-style: none;
        }
        .feature-list li {
            margin-bottom: 1rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }
        .feature-list li i {
            color: #22c55e;
            margin-right: 0.7em;
            font-size: 1.3em;
        }
        .preview-button {
            background: #22c55e;
            color: #fff;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(34,197,94,0.08);
            transition: background 0.2s;
        }
        .preview-button:hover {
            background: #16a34a;
        }
        .demo-preview {
            flex: 2 1 500px;
            min-height: 500px;
            background: #fff;
            border-left: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .demo-preview iframe, .demo-preview img {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 0 16px 16px 0;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }
        .preview-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #64748b;
            font-size: 1.2rem;
        }
        .preview-placeholder i {
            font-size: 3rem;
            color: #4f46e5;
            margin-bottom: 1rem;
        }
        @media (max-width: 900px) {
            .demo-preview-container {
                flex-direction: column;
            }
            .demo-preview {
                border-left: none;
                border-top: 1px solid #e5e7eb;
                border-radius: 0 0 16px 16px;
                min-height: 300px;
            }
        }
    </style>

    <div class="demo-description">
        <a href="{{ url('/') }}" class="exit-btn" style="
        position: absolute;
        top: 18px;
        right: 28px;
        z-index: 2000;
        background: #070606;
        color: #ececf1;
        border: none;
        border-radius: 50px;
        padding: 8px 22px 8px 16px;
        font-weight: bold;
        font-size: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    ">
        <i class="fa fa-arrow-left"></i> Exit
    </a>
        <h1>
            <i class="fa fa-bus-alt" style="margin-right:10px;"></i>
            TranspoFlow Admin Panel Preview
        </h1>
        <p>
            Experience the power of your transport company dashboard. Manage tickets, cargo, fleet, and analytics—all in one place.
        </p>
        <ul class="feature-list">
            <li><i class="fa fa-users"></i> Advanced User & Role Management</li>
            <li><i class="fa fa-chart-line"></i> Real-Time Analytics & Reports</li>
            <li><i class="fa fa-bus"></i> Fleet & Route Optimization</li>
            <li><i class="fa fa-box"></i> Cargo & Booking Automation</li>
            <li><i class="fa fa-bell"></i> Instant Notifications & Alerts</li>
        </ul>
        <button wire:click="togglePreview" class="preview-button">
            {{ $showLivePreview ? 'Hide Live Preview' : 'Show Live Preview' }}
        </button>
    </div>

    <div class="demo-preview">
        @if($showLivePreview)
            <iframe 
                src="{{ route('demo.admin') }}" 
                frameborder="0"
                loading="lazy"
            ></iframe>
        @else
            <div class="preview-placeholder">
                <i class="fa fa-desktop"></i>
                <p>Click "Show Live Preview" to see your admin dashboard in action!</p>
            </div>
        @endif
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</div>

