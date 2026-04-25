<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
const props = defineProps<{canRegister: boolean}>()
</script>
<template>
  <div class="page">
    <!-- Nav -->
    <nav class="nav">
      <span class="nav-logo">ShiftSync</span>
      <div class="nav-links">
        <Link :href="route('login')" class="btn-ghost">Sign in</Link>
        <Link v-if="canRegister" :href="route('register')" class="btn-primary">Get started</Link>
      </div>
    </nav>
    <!-- Hero -->
    <header class="hero">
      <div class="hero-eyebrow">Workforce scheduling, simplified</div>
      <h1 class="hero-heading">
        Every shift,<br>
        <span class="hero-heading-accent">in its place.</span>
      </h1>
      <p class="hero-sub">
        Managers create and assign shifts. Employees claim open ones.
        No spreadsheets, no group chats, no confusion.
      </p>
      <div class="hero-actions">
        <Link v-if="canRegister" :href="route('register')" class="btn-primary btn-large">
          Create an account
        </Link>
        <Link :href="route('login')" class="btn-outline btn-large">Sign in</Link>
      </div>
    </header>
    <!-- Features -->
    <section class="features">
      <div class="feature-card">
        <div class="feature-icon">&#9632;</div>
        <h3>Build the schedule</h3>
        <p>Managers can create, edit, and delete shifts from a single view. Assign them immediately or leave them open for employees to claim.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">&#9632;</div>
        <h3>Claim open shifts</h3>
        <p>Employees see their own upcoming shifts alongside any unclaimed ones. One tap to claim — no manager approval needed.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">&#9632;</div>
        <h3>Manage your team</h3>
        <p>Keep a full roster of employees, view who's working when, and control account access — all in one place.</p>
      </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
      <span>© {{ new Date().getFullYear() }} ShiftSync</span>
    </footer>
  </div>
</template>
<style scoped>
/* ── Tokens ── */
:root {
  --ink:       #1a1a18;
  --ink-muted: #6b6b65;
  --surface:   #f5f4ef;
  --card-bg:   #ffffff;
  --accent:    #2a6e4e;
  --accent-lt: #e1f0e9;
  --border:    rgba(0,0,0,0.10);
  --font-display: 'Georgia', 'Times New Roman', serif;
  --font-body:    'Helvetica Neue', Arial, sans-serif;
}
/* ── Reset & base ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
.page {
  min-height: 100vh;
  background: var(--surface);
  color: var(--ink);
  font-family: var(--font-body);
  display: flex;
  flex-direction: column;
}
/* ── Nav ── */
.nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.25rem 3rem;
  border-bottom: 1px solid var(--border);
  background: var(--surface);
  position: sticky;
  top: 0;
  z-index: 10;
}
.nav-logo {
  font-family: var(--font-display);
  font-size: 1.25rem;
  letter-spacing: -0.02em;
  color: var(--ink);
}
.nav-links {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
/* ── Hero ── */
.hero {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 6rem 2rem 5rem;
  max-width: 760px;
  margin: 0 auto;
  width: 100%;
}
.hero-eyebrow {
  font-size: 0.8125rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--accent);
  font-weight: 500;
  margin-bottom: 1.5rem;
}
.hero-heading {
  font-family: var(--font-display);
  font-size: clamp(3rem, 8vw, 5.5rem);
  font-weight: 400;
  line-height: 1.05;
  letter-spacing: -0.03em;
  color: var(--ink);
  margin-bottom: 1.5rem;
}
.hero-heading-accent {
  color: var(--accent);
  font-style: italic;
}
.hero-sub {
  font-size: 1.0625rem;
  line-height: 1.7;
  color: var(--ink-muted);
  max-width: 480px;
  margin-bottom: 2.5rem;
}
.hero-actions {
  display: flex;
  gap: 0.75rem;
  flex-wrap: wrap;
  justify-content: center;
}
/* ── Features ── */
.features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1px;
  background: var(--border);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.feature-card {
  background: var(--card-bg);
  padding: 2.5rem 2rem;
}
.feature-icon {
  font-size: 0.55rem;
  color: var(--accent);
  margin-bottom: 1rem;
  line-height: 1;
}
.feature-card h3 {
  font-family: var(--font-display);
  font-size: 1.125rem;
  font-weight: 400;
  letter-spacing: -0.01em;
  margin-bottom: 0.625rem;
  color: var(--ink);
}
.feature-card p {
  font-size: 0.9375rem;
  line-height: 1.65;
  color: var(--ink-muted);
}
/* ── Footer ── */
.footer {
  text-align: center;
  padding: 1.5rem;
  font-size: 0.8125rem;
  color: var(--ink-muted);
  border-top: 1px solid var(--border);
}
/* ── Buttons ── */
.btn-primary {
  display: inline-flex;
  align-items: center;
  padding: 0.6rem 1.25rem;
  background: var(--accent);
  color: #fff;
  border-radius: 4px;
  font-size: 0.9375rem;
  font-family: var(--font-body);
  text-decoration: none;
  transition: opacity 0.15s;
  border: none;
  cursor: pointer;
}
.btn-primary:hover {
  opacity: 0.88;
}
.btn-outline {
  display: inline-flex;
  align-items: center;
  padding: 0.6rem 1.25rem;
  background: transparent;
  color: var(--ink);
  border: 1px solid var(--border);
  border-radius: 4px;
  font-size: 0.9375rem;
  font-family: var(--font-body);
  text-decoration: none;
  transition: background 0.15s;
  cursor: pointer;
}
.btn-outline:hover {
  background: rgba(0,0,0,0.04);
}
.btn-ghost {
  display: inline-flex;
  align-items: center;
  padding: 0.5rem 0.875rem;
  font-size: 0.9375rem;
  color: var(--ink-muted);
  text-decoration: none;
  border-radius: 4px;
  transition: color 0.15s;
}
.btn-ghost:hover {
  color: var(--ink);
}
.btn-large {
  padding: 0.75rem 1.75rem;
  font-size: 1rem;
}
/* ── Responsive ── */
@media (max-width: 640px) {
  .nav {
    padding: 1rem 1.25rem;
  }
  .hero {
    padding: 4rem 1.5rem 3.5rem;
  }
  .feature-card {
    padding: 2rem 1.5rem;
  }
}
</style>