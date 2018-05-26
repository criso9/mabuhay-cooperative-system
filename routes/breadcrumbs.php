<?php

// Admin

Breadcrumbs::register('admin.index', function ($breadcrumbs) {
     $breadcrumbs->push('Dashboard', route('admin.index'));
});

Breadcrumbs::register('admin.member.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Members', route('admin.member.index'));
});

Breadcrumbs::register('admin.member.show', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.member.index');
    $breadcrumbs->push('Profile', url('users/member/show/{member}'));
});

Breadcrumbs::register('admin.officer.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Officers', route('admin.officer.index'));
});

Breadcrumbs::register('admin.admin.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Admins', route('admin.admin.index'));
});

Breadcrumbs::register('admin.coop', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Setup', route('admin.coop'));
});

Breadcrumbs::register('admin.pending.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Membership Approval', route('admin.pending.index'));
});

Breadcrumbs::register('admin.database.backup', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Database', route('admin.database.backup'));
});

Breadcrumbs::register('admin.business.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Business', route('admin.business.index'));
});

Breadcrumbs::register('admin.business.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.business.index');
    $breadcrumbs->push('Business Information', url('business/{name}'));
});

Breadcrumbs::register('admin.poll.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Poll', route('admin.poll.index'));
});

Breadcrumbs::register('admin.poll.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.poll.index');
    $breadcrumbs->push('Create Poll', route('admin.poll.create'));
});

Breadcrumbs::register('admin.poll.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.poll.index');
    $breadcrumbs->push('Edit Poll', url('polls/{poll}'));
});

Breadcrumbs::register('admin.poll.options.push', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.poll.index');
    $breadcrumbs->push('Edit Poll Options', url('polls/{poll}/options/add'));
});

Breadcrumbs::register('admin.poll.options.remove', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.poll.index');
    $breadcrumbs->push('Remove Poll Options', url('polls/{poll}/options/remove'));
});

// OFFICER

Breadcrumbs::register('officer.index', function ($breadcrumbs) {
    $breadcrumbs->push('Officer', route('officer.index'));
});

Breadcrumbs::register('officer.contribution.monthly', function ($breadcrumbs) {
	$breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Monthly Contribution', route('officer.contribution.monthly'));
});

Breadcrumbs::register('officer.contribution.monthly.member', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.contribution.monthly');
    $breadcrumbs->push('Member', url('contribution/month/{member}'));
});

Breadcrumbs::register('officer.contribution.damayan', function ($breadcrumbs) {
	$breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Damayan', route('officer.contribution.damayan'));
});

Breadcrumbs::register('officer.contribution.sharecapital', function ($breadcrumbs) {
	$breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Share Capital', route('officer.contribution.sharecapital'));
});

Breadcrumbs::register('officer.loan.index', function ($breadcrumbs) {
	$breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Loan Approval', route('officer.loan.index'));
});

Breadcrumbs::register('officer.business.index', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Business', route('officer.business.index'));
});

Breadcrumbs::register('officer.member.index', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Members', route('officer.member.index'));
});

Breadcrumbs::register('officer.member.show', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.member.index');
    $breadcrumbs->push('Profile', url('/officer/member/show/{member}'));
});

Breadcrumbs::register('officer.documents.index', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Documents', route('officer.documents.index'));
});

Breadcrumbs::register('officer.announcements.index', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.index');
    $breadcrumbs->push('Announcements', route('officer.announcements.index'));
});

Breadcrumbs::register('officer.announcements.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('officer.announcements.index');
    $breadcrumbs->push('Edit', url('/officer/announcements/edit/{id}'));
});

// Member

Breadcrumbs::register('member.index', function ($breadcrumbs) {
    $breadcrumbs->push('Member', route('member.index'));
});

Breadcrumbs::register('member.contribution.monthly', function ($breadcrumbs) {
	$breadcrumbs->parent('member.index');
    $breadcrumbs->push('Monthly Contribution', route('member.contribution.monthly'));
});

Breadcrumbs::register('member.contribution.damayan', function ($breadcrumbs) {
	$breadcrumbs->parent('member.index');
    $breadcrumbs->push('Damayan', route('member.contribution.damayan'));
});

Breadcrumbs::register('member.contribution.sharecapital', function ($breadcrumbs) {
    $breadcrumbs->parent('member.index');
    $breadcrumbs->push('Share Capital', route('member.contribution.sharecapital'));
});

Breadcrumbs::register('member.loan.index', function ($breadcrumbs) {
	$breadcrumbs->parent('member.index');
    $breadcrumbs->push('Loan', route('member.loan.index'));
});

Breadcrumbs::register('member.report', function ($breadcrumbs) {
	$breadcrumbs->parent('member.index');
    $breadcrumbs->push('Report', route('member.report'));
});