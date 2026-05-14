import React from 'react';
import { createRoot } from 'react-dom/client';
import { FloatingTravelAssistant } from './components/vanessa-assistant';

const assistantRoot = document.getElementById('vanessa-travel-assistant');

if (assistantRoot) {
    createRoot(assistantRoot).render(
        React.createElement(
            React.StrictMode,
            null,
            React.createElement(FloatingTravelAssistant),
        ),
    );
}
