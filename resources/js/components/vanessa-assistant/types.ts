export type VanessaMood = 'idle' | 'wave' | 'thinking' | 'peek' | 'walk';

export type AssistantMessage = {
    id: string;
    role: 'assistant' | 'user';
    text: string;
};

export type DestinationSuggestion = {
    label: string;
    message: string;
};
