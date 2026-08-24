<style>
.github-repo-card {
    margin: 32px 0;
}

.github-repo-card__link {
    display: block;
    padding: 20px;
    border: 1px solid #d0d7de;
    border-radius: 8px;
    text-decoration: none !important;
    color: inherit !important;
    transition: box-shadow 0.2s, background-color 0.15s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}

.github-repo-card__link:hover {
    background-color: #f6f8fa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.github-repo-card__header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.github-repo-card__avatar {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    flex-shrink: 0;
}

.github-repo-card__owner {
    color: #656d76;
    font-size: 15px;
}

.github-repo-card__separator {
    color: #656d76;
    font-size: 15px;
    margin: 0 2px;
}

.github-repo-card__name {
    color: #0969da;
    font-size: 15px;
    font-weight: 600;
}

.github-repo-card__link:hover .github-repo-card__name {
    text-decoration: underline;
}

.github-repo-card__badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border: 1px solid #d0d7de;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    color: #656d76;
    margin-left: auto;
    flex-shrink: 0;
}

.github-repo-card__description {
    margin: 10px 0 0;
    color: #656d76;
    font-size: 14px;
    line-height: 1.6;
}

.github-repo-card__footer {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 14px;
    font-size: 13px;
    color: #656d76;
}

.github-repo-card__stat {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.github-repo-card__lang-dot {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #6e7681;
}

.github-repo-card__fork-icon {
    flex-shrink: 0;
}

.github-repo-card__cta {
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid #e8ecef;
    font-size: 13px;
    font-weight: 500;
    color: #0969da;
}

.github-repo-card__cta:hover {
    text-decoration: underline;
}

@media (prefers-color-scheme: dark) {
    .github-repo-card__link {
        border-color: #30363d;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    .github-repo-card__link:hover {
        background-color: #161b22;
        box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }

    .github-repo-card__owner,
    .github-repo-card__separator,
    .github-repo-card__description,
    .github-repo-card__footer,
    .github-repo-card__badge {
        color: #8b949e;
    }

    .github-repo-card__name {
        color: #58a6ff;
    }

    .github-repo-card__badge {
        border-color: #30363d;
    }

    .github-repo-card__cta {
        color: #58a6ff;
        border-top-color: #21262d;
    }
}
</style>

<div class="github-repo-card" itemscope itemtype="https://schema.org/SoftwareSourceCode">
    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="github-repo-card__link" itemprop="url">
        <div class="github-repo-card__header">
            <img class="github-repo-card__avatar" src="{{ $repo['owner']['avatar_url'] }}" alt="" width="40" height="40" loading="lazy" itemprop="image">
            <div>
                <span class="github-repo-card__owner" itemprop="author">{{ $repo['owner']['login'] }}</span>
                <span class="github-repo-card__separator">/</span>
                <strong class="github-repo-card__name" itemprop="name">{{ $repo['name'] }}</strong>
            </div>
            <span class="github-repo-card__badge">
                <svg viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
                GitHub
            </span>
        </div>
        @if ($repo['description'])
            <p class="github-repo-card__description" itemprop="description">{{ $repo['description'] }}</p>
        @endif
        <div class="github-repo-card__footer">
            @if ($repo['language'])
                <span class="github-repo-card__stat">
                    <span class="github-repo-card__lang-dot"></span>
                    {{ $repo['language'] }}
                </span>
            @endif
            <span class="github-repo-card__stat">★ {{ number_format($repo['stargazers_count']) }}</span>
            <span class="github-repo-card__stat">
                <svg class="github-repo-card__fork-icon" viewBox="0 0 16 16" width="14" height="14" fill="currentColor"><path d="M5 5.372v.878c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75v-.878a2.25 2.25 0 1 1 1.5 0v.878a2.25 2.25 0 0 1-2.25 2.25h-1.5v2.128a2.251 2.251 0 1 1-1.5 0V8.5h-1.5A2.25 2.25 0 0 1 3.5 6.25v-.878a2.25 2.25 0 1 1 1.5 0ZM5 3.25a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Zm6.75.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm-3 8.75a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Z"></path></svg>
                {{ number_format($repo['forks_count']) }}
            </span>
            @if ($repo['license']['spdx_id'] ?? null)
                <span class="github-repo-card__stat" itemprop="license">{{ $repo['license']['spdx_id'] }}</span>
            @endif
        </div>
        <div class="github-repo-card__cta">View on GitHub →</div>
    </a>
</div>