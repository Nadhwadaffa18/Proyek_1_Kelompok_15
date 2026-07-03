---
version: "modern-education-lms-v1"
name: "Aksara"
description: "Aksara Learning Management System is designed as a modern web-based education platform that centralizes digital learning activities for administrators, teachers, and students. The interface emphasizes clarity, accessibility, and productivity with a clean dashboard, structured navigation, and responsive user experience."

colors:
  primary: "#4F46E5"
  secondary: "#4338CA"
  accent: "#10B981"
  background: "#F8FAFC"
  surface: "#FFFFFF"
  text-primary: "#0F172A"
  text-secondary: "#64748B"
  border: "#E2E8F0"
  warning: "#F59E0B"
  danger: "#F43F5E"

typography:
  display-lg:
    fontFamily: "Inter"
    fontSize: "56px"
    fontWeight: 700
    lineHeight: "1.1"
    letterSpacing: "-0.03em"

  heading-md:
    fontFamily: "Inter"
    fontSize: "32px"
    fontWeight: 600
    lineHeight: "1.25"

  body-md:
    fontFamily: "Inter"
    fontSize: "16px"
    fontWeight: 400
    lineHeight: "1.7"

  label-md:
    fontFamily: "JetBrains Mono"
    fontSize: "12px"
    fontWeight: 600
    lineHeight: "1.2"

spacing:
  base: "8px"
  gap: "24px"
  card-padding: "24px"
  section-padding: "96px"

rounded:
  card: "18px"
  control: "12px"
  button: "12px"
  pill: "9999px"

components:
  sidebar:
    background: "White surface with subtle border"
    width: "280px"
    active-state: "Primary background with white text"

  navbar:
    background: "Transparent with blur effect"
    height: "72px"

  card:
    background: "White"
    border: "1px solid border token"
    shadow: "Soft large shadow"
    radius: "18px"

  button:
    primary: "Primary Indigo"
    secondary: "White with border"
    radius: "12px"

  stats-card:
    layout: "Icon + Metric + Description"

  dashboard-grid:
    columns: "Responsive 4 / 2 / 1"

---

# Aksara - Learning Management System

Source: Aksara Project Documentation 2026.

Tags:
education,
learning management system,
dashboard,
laravel,
tailwindcss,
teacher,
student,
admin,
responsive,
modern ui

## Overview

Aksara is a web-based Learning Management System that provides a centralized environment for digital learning activities. The platform connects administrators, teachers, and students into one integrated ecosystem where classroom management, assignments, quizzes, learning materials, grades, schedules, and discussions are managed efficiently.

The overall experience should feel modern, organized, and approachable while maintaining high usability across desktop and mobile devices.

---

## Composition

Preserve the hierarchy of a modern SaaS dashboard.

First viewport should immediately communicate:

- Application branding
- Welcome headline
- Quick statistics
- Primary navigation
- Active learning activities

Dashboard sections should naturally flow into:

- Statistics
- Active Classes
- Recent Materials
- Upcoming Assignments
- Notifications
- Discussion Activity

Avoid unnecessary decorative elements that distract from productivity.

---

## Colors

The interface should emphasize trust, education, and productivity.

Primary colors:

- Indigo (#4F46E5)
- Deep Indigo (#4338CA)

Supporting colors:

- Emerald (#10B981)
- Amber (#F59E0B)
- Rose (#F43F5E)

Neutral palette:

- Slate Background (#F8FAFC)
- White Surface (#FFFFFF)
- Border (#E2E8F0)
- Text Primary (#0F172A)
- Text Secondary (#64748B)

Use generous whitespace to create visual comfort.

---

## Typography

Use **Inter** as the primary typeface.

Hierarchy:

- Large Bold Headlines
- Medium Section Titles
- Comfortable Body Text
- Mono labels for metadata

Maintain excellent readability with generous spacing.

---

## Layout

Desktop:

- Fixed left sidebar
- Sticky top navigation
- Responsive content area
- Card-based dashboard

Tablet:

- Collapsible sidebar
- Two-column content grid

Mobile:

- Bottom navigation or drawer
- Single-column layout
- Large touch targets

Spacing should feel premium rather than compact.

---

## Components

Important reusable components include:

- Login Card
- Dashboard Cards
- Statistics Cards
- Classroom Cards
- Material Cards
- Assignment Cards
- Quiz Cards
- Discussion Threads
- Grade Tables
- Schedule Timeline
- Notification Panel
- User Profile Dropdown
- Search Bar
- Role Badge
- Primary CTA Button

Cards should feature soft shadows and rounded corners with subtle hover elevation.

---

## Motion

Use subtle animations throughout the application.

Examples include:

- Fade-up page transitions
- Card hover lift
- Sidebar expansion
- Button ripple
- Notification slide-in
- Loading skeleton
- Progress animations
- Smooth modal transitions
- Interactive dropdown animations

Animations should remain fast, lightweight, and purposeful.

---

## WebGL & Effects

No WebGL is required.

Instead, enhance the interface using:

- Soft gradients
- Glassmorphism navbar
- Background blur
- Floating decorative shapes
- Micro interactions
- Animated statistics counters
- Gradient icon backgrounds

Visual effects should support usability instead of becoming the main attraction.

---

## Guardrails

- Do not replace the dashboard with a generic landing page.
- Preserve role-based navigation (Admin, Teacher, Student).
- Keep dashboard cards as the primary interaction pattern.
- Use generous whitespace.
- Maintain accessibility with sufficient color contrast.
- Ensure responsive behavior on desktop, tablet, and mobile.
- Prioritize usability over visual complexity.
- Use consistent spacing and rounded corner language throughout the application.
- Preserve educational branding and professional appearance.