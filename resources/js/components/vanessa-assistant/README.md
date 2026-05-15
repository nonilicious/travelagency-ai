# Vanessa Floating Travel Assistant

Animated React/Next.js assistant inspired by the Vanessa character sheet:

- floating bottom-right assistant
- idle breathing, swaying and walking offsets
- real sprite assets extracted from the Vanessa character sheet
- inactive wave after 10 seconds
- destination suggestions and peek behavior
- glassmorphism chat window
- typing indicator
- responsive Tailwind styling

## Install

```bash
npm install framer-motion react react-dom
```

## Next.js Usage

Copy `resources/js/components/vanessa-assistant` into your Next.js app, for example:

```text
src/components/vanessa-assistant
```

Then render it once in your root layout or page shell:

```tsx
import { FloatingTravelAssistant } from '@/components/vanessa-assistant';

export default function RootLayout({ children }: { children: React.ReactNode }) {
    return (
        <html lang="de">
            <body>
                {children}
                <FloatingTravelAssistant />
            </body>
        </html>
    );
}
```

Make sure Tailwind scans the component path:

```ts
content: ['./src/**/*.{ts,tsx}'];
```

## Laravel/Vite React Island

This repository is currently Laravel Blade, not Next.js. To use Vanessa directly here, add React support to Vite and mount `<FloatingTravelAssistant />` into a small DOM node in the public layout.

## Character Assets

The current live assistant uses sprite images in:

```text
public/images/vanessa
```

These are lightweight WebP crops from the uploaded character sheet. The React logic can later be switched to a `.riv` file without changing the chat window.

## Customizing Messages

Edit:

```text
assistant-data.ts
```

Use `useVanessaAssistant.ts` to connect the submit handler to a real chat API or your Laravel contact form endpoint later.
