import type { AssistantMessage, DestinationSuggestion } from './types';

export const initialMessages: AssistantMessage[] = [
    {
        id: 'welcome',
        role: 'assistant',
        text: 'Ciao, ich bin Vanessa. Erzaehl mir kurz, wie sich deine Reise anfuehlen soll.',
    },
    {
        id: 'prompt',
        role: 'assistant',
        text: 'Ich kann dir helfen, eine Anfrage fuer die Agency vorzubereiten.',
    },
];

export const destinationSuggestions: DestinationSuggestion[] = [
    {
        label: 'Amalfi Coast',
        message: 'Lust auf Kueste, Boutique-Hotels und gutes Essen in Italien?',
    },
    {
        label: 'Kyoto',
        message: 'Kyoto waere schoen fuer Kultur, Teehaeuser und ruhige Premium-Stays.',
    },
    {
        label: 'Mallorca',
        message: 'Mallorca passt gut fuer Designhotels, Meerblick und kurze Flugzeiten.',
    },
    {
        label: 'Iceland',
        message: 'Island ist stark fuer Natur, Lodges und private Guides.',
    },
];
