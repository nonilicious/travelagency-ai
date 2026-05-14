'use client';

import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import { destinationSuggestions, initialMessages } from './assistant-data';
import type { AssistantMessage, VanessaMood } from './types';

const WELCOME_DELAY_MS = 10_000;
const INACTIVE_WAVE_MS = 18_000;
const PEEK_AFTER_MS = 34_000;

const createId = () => globalThis.crypto?.randomUUID?.() ?? `${Date.now()}-${Math.random()}`;

export function useVanessaAssistant() {
    const [isOpen, setIsOpen] = useState(false);
    const [isBubbleVisible, setIsBubbleVisible] = useState(false);
    const [isTyping, setIsTyping] = useState(false);
    const [mood, setMood] = useState<VanessaMood>('idle');
    const [messages, setMessages] = useState<AssistantMessage[]>(initialMessages);
    const [draft, setDraft] = useState('');
    const [walkOffset, setWalkOffset] = useState({ x: 0, y: 0 });
    const lastInteractionRef = useRef(Date.now());

    const suggestion = useMemo(() => {
        const index = Math.floor(Date.now() / 1000) % destinationSuggestions.length;

        return destinationSuggestions[index];
    }, [isBubbleVisible, mood]);

    const markInteraction = useCallback(() => {
        lastInteractionRef.current = Date.now();
        setMood('idle');
        setIsBubbleVisible(false);
    }, []);

    const openChat = useCallback(() => {
        markInteraction();
        setIsOpen(true);
    }, [markInteraction]);

    const closeChat = useCallback(() => {
        markInteraction();
        setIsOpen(false);
    }, [markInteraction]);

    const sendMessage = useCallback((text: string) => {
        const cleanText = text.trim();

        if (!cleanText) {
            return;
        }

        markInteraction();
        setDraft('');
        setMessages((current) => [
            ...current,
            {
                id: createId(),
                role: 'user',
                text: cleanText,
            },
        ]);
        setIsTyping(true);
        setMood('thinking');

        window.setTimeout(() => {
            setIsTyping(false);
            setMood('idle');
            setMessages((current) => [
                ...current,
                {
                    id: createId(),
                    role: 'assistant',
                    text: 'Super. Ich wuerde Reiseziel, Zeitraum, Budget und Reisestil sammeln und daraus eine klare Anfrage fuer die Agency machen.',
                },
            ]);
        }, 1100);
    }, [markInteraction]);

    useEffect(() => {
        const welcomeTimer = window.setTimeout(() => {
            if (!isOpen) {
                setIsBubbleVisible(true);
                setMood('wave');
            }
        }, WELCOME_DELAY_MS);

        return () => window.clearTimeout(welcomeTimer);
    }, [isOpen]);

    useEffect(() => {
        const interval = window.setInterval(() => {
            const inactiveFor = Date.now() - lastInteractionRef.current;

            if (isOpen) {
                return;
            }

            if (inactiveFor > PEEK_AFTER_MS) {
                setMood('peek');
                setIsBubbleVisible(true);
                return;
            }

            if (inactiveFor > INACTIVE_WAVE_MS) {
                setMood('wave');
                setIsBubbleVisible(true);
            }
        }, 4500);

        return () => window.clearInterval(interval);
    }, [isOpen]);

    useEffect(() => {
        const interval = window.setInterval(() => {
            if (isOpen || mood === 'peek') {
                return;
            }

            setMood('walk');
            setWalkOffset({
                x: Math.round(Math.random() * 18 - 9),
                y: Math.round(Math.random() * 10 - 5),
            });

            window.setTimeout(() => setMood('idle'), 1400);
        }, 12_000);

        return () => window.clearInterval(interval);
    }, [isOpen, mood]);

    useEffect(() => {
        if (!isBubbleVisible || isOpen) {
            return;
        }

        const timer = window.setTimeout(() => {
            setIsBubbleVisible(false);
            setMood('idle');
        }, 8500);

        return () => window.clearTimeout(timer);
    }, [isBubbleVisible, isOpen]);

    return {
        closeChat,
        draft,
        isBubbleVisible,
        isOpen,
        isTyping,
        markInteraction,
        messages,
        mood,
        openChat,
        sendMessage,
        setDraft,
        suggestion,
        walkOffset,
    };
}
