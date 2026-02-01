<?php

namespace App\Services;

/**
 * Widget Registry for Global Dashboard
 * 
 * Allows modules to register dashboard widgets that will be
 * dynamically loaded on the global dashboard.
 */
class WidgetRegistry
{
    protected array $widgets = [];

    /**
     * Register a widget from a module
     */
    public function register(
        string $key,
        string $component,
        array $props = [],
        int $order = 100,
        ?string $title = null
    ): self {
        $this->widgets[$key] = [
            'key' => $key,
            'component' => $component,
            'props' => $props,
            'order' => $order,
            'title' => $title,
        ];

        return $this;
    }

    /**
     * Get all registered widgets sorted by order
     */
    public function getWidgets(): array
    {
        return collect($this->widgets)
            ->sortBy('order')
            ->values()
            ->all();
    }

    /**
     * Get a specific widget by key
     */
    public function get(string $key): ?array
    {
        return $this->widgets[$key] ?? null;
    }

    /**
     * Check if a widget exists
     */
    public function has(string $key): bool
    {
        return isset($this->widgets[$key]);
    }

    /**
     * Remove a widget
     */
    public function remove(string $key): self
    {
        unset($this->widgets[$key]);
        return $this;
    }

    /**
     * Get widget count
     */
    public function count(): int
    {
        return count($this->widgets);
    }
}
