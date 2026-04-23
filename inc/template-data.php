<?php
/**
 * Static theme data.
 *
 * @package Katalyst
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return static site data.
 *
 * @return array<string,mixed>
 */
function katalyst_get_theme_data(): array {
	return array(
		'nav'        => array(
			array( 'label' => __( 'Projekt', 'katalyst' ), 'anchor' => 'projekt' ),
			array( 'label' => __( 'Ansatz', 'katalyst' ), 'anchor' => 'ansatz' ),
			array( 'label' => __( 'Plattform', 'katalyst' ), 'anchor' => 'plattform' ),
			array( 'label' => __( 'Forschung', 'katalyst' ), 'anchor' => 'forschung' ),
			array( 'label' => __( 'News', 'katalyst' ), 'anchor' => 'news' ),
			array( 'label' => __( 'Partner', 'katalyst' ), 'anchor' => 'partner' ),
			array( 'label' => __( 'Kontakt', 'katalyst' ), 'anchor' => 'kontakt' ),
		),
		'hero'       => array(
			'eyebrow' => __( 'Forschungsprojekt · Hochschule Kempten · 2025 – 2028', 'katalyst' ),
			'title'    => __( 'Hochschullehre mit generativer KI: nutzbar. fair. zukunftsfähig.', 'katalyst' ),
			'lede'     => __( 'KATALYST entwickelt eine frei verfügbare Plattform für personalisiertes Lernen, effizientere Materialerstellung und moderne, transparente Prüfungsformate — datenschutzkonform, barrierearm, modular integrierbar.', 'katalyst' ),
			'stats'    => array(
				array( 'label' => __( 'Laufzeit', 'katalyst' ), 'value' => __( '3 Jahre', 'katalyst' ) ),
				array( 'label' => __( 'Plattform', 'katalyst' ), 'value' => __( 'modular', 'katalyst' ) ),
				array( 'label' => __( 'Komponenten', 'katalyst' ), 'value' => '6' ),
				array( 'label' => __( 'Zugang', 'katalyst' ), 'value' => __( 'frei', 'katalyst' ) ),
			),
		),
		'feed'       => array(
			array( 'day' => '12', 'month' => __( 'März · 26', 'katalyst' ), 'type' => 'news', 'title' => __( 'Pilotphase startet an der HS Kempten', 'katalyst' ) ),
			array( 'day' => '04', 'month' => __( 'März · 26', 'katalyst' ), 'type' => 'blog', 'title' => __( 'Was fair geprüft werden kann', 'katalyst' ) ),
			array( 'day' => '26', 'month' => __( 'Feb · 26', 'katalyst' ), 'type' => 'event', 'title' => __( 'Fachtag: KI in der Lehre', 'katalyst' ) ),
			array( 'day' => '14', 'month' => __( 'Feb · 26', 'katalyst' ), 'type' => 'publ', 'title' => __( 'Whitepaper v1 veröffentlicht', 'katalyst' ) ),
		),
		'about'      => array(
			'lead' => __( 'Ein Forschungsprojekt zur grundlegenden Modernisierung der Hochschullehre mit generativer KI — gestartet an der Hochschule Kempten.', 'katalyst' ),
			'body' => __( 'Entwickelt wird eine hochschulweite, frei verfügbare Plattform, die Studierende beim Lernen unterstützt und Lehrende bei Materialerstellung, Korrektur und Prüfungsdurchführung entlastet. Die Komponenten sind modular einsetzbar und können an bestehende Systeme angebunden werden.', 'katalyst' ),
			'tags' => array( __( 'datenschutzkonform', 'katalyst' ), __( 'barrierearm', 'katalyst' ), __( 'modular', 'katalyst' ), __( 'offen', 'katalyst' ) ),
		),
		'pillars'    => array(
			array( 'marker' => 'sq b', 'label' => __( '01 — Studierende', 'katalyst' ), 'title' => __( 'Personalisiertes Lernen', 'katalyst' ), 'body' => __( 'Lernbegleitung, die auf Vorwissen, Tempo und Ziele reagiert — mit Fokus auf Selbstwirksamkeit und Reflexion.', 'katalyst' ) ),
			array( 'marker' => 'qc g', 'label' => __( '02 — Lehrende', 'katalyst' ), 'title' => __( 'Effizientere Materialerstellung', 'katalyst' ), 'body' => __( 'KI-Werkzeuge, die Lehrende bei Recherche, Aufbereitung und Aktualisierung von Lerninhalten entlasten.', 'katalyst' ) ),
			array( 'marker' => 'sq n', 'label' => __( '03 — Prüfung', 'katalyst' ), 'title' => __( 'Transparente Prüfungsformate', 'katalyst' ), 'body' => __( 'Prüfungsformate, die KI kontrolliert einbinden — fair, nachvollziehbar und für alle Studierenden verfügbar.', 'katalyst' ) ),
		),
		'components' => array(
			array( 'category' => __( '01 · Material', 'katalyst' ), 'marker' => 'sq b', 'title' => 'FactTrack', 'body' => __( 'Automatisierte, themenspezifische Literaturrecherche und Bewertung wissenschaftlicher Quellen.', 'katalyst' ), 'chips' => array( __( 'Recherche', 'katalyst' ), __( 'Qualitätskriterien', 'katalyst' ), __( 'Aktualisierung', 'katalyst' ) ) ),
			array( 'category' => __( '02 · Lernen', 'katalyst' ), 'marker' => 'qc b', 'title' => 'DigitalTwin', 'body' => __( 'Virtueller Lernbegleiter, der Fachwissen und Kommunikationsstil einer Lehrperson abbildet.', 'katalyst' ), 'chips' => array( __( '24/7 verfügbar', 'katalyst' ), __( 'Personalisiert', 'katalyst' ), __( 'Reflektierend', 'katalyst' ) ) ),
			array( 'category' => __( '03 · Lernen', 'katalyst' ), 'marker' => 'sq g', 'title' => 'EduGameFactory', 'body' => __( 'KI-gestützte Generierung didaktisch hochwertiger Serious Games aus Lehrinhalten.', 'katalyst' ), 'chips' => array( __( 'Serious Games', 'katalyst' ), __( 'Didaktik-geleitet', 'katalyst' ), __( 'Motivation', 'katalyst' ) ) ),
			array( 'category' => __( '04 · Prüfung', 'katalyst' ), 'marker' => 'qc g', 'title' => 'Gexam', 'body' => __( 'Zukunftsfähige Prüfungsformate mit KI-Rollen — Mentor, Peer, Prüfer. Transparent und fair.', 'katalyst' ), 'chips' => array( __( 'KI-Rollen', 'katalyst' ), __( 'Kontrolliert', 'katalyst' ), __( 'Barrierefrei', 'katalyst' ) ) ),
			array( 'category' => __( '05 · Material', 'katalyst' ), 'marker' => 'sq n', 'title' => 'SourceVerifier', 'body' => __( 'Intelligente Quellenprüfung zur Erkennung fehlerhafter oder erfundener Referenzen.', 'katalyst' ), 'chips' => array( __( 'Zitierpraxis', 'katalyst' ), __( 'Fact-Checking', 'katalyst' ), __( 'Wissenschaftlich', 'katalyst' ) ) ),
			array( 'category' => __( '06 · Prüfung', 'katalyst' ), 'marker' => 'qc n', 'title' => 'ExamAssistant', 'body' => __( 'Objektive, teilautomatisierte Prüfungsbewertung — inklusive Transkription und begründetem Scoring.', 'katalyst' ), 'chips' => array( __( 'Transkription', 'katalyst' ), __( 'Folgefragen', 'katalyst' ), __( 'Begründetes Scoring', 'katalyst' ) ) ),
		),
		'research'   => array(
			array( 'label' => 'Q1', 'title' => __( 'Wie bleibt Prüfung fair?', 'katalyst' ), 'body' => __( 'Wie integrieren wir generative KI in Prüfungsformate, ohne Fairness, Chancengleichheit und Prüfungssicherheit zu unterlaufen?', 'katalyst' ) ),
			array( 'label' => 'Q2', 'title' => __( 'Was brauchen Lehrende wirklich?', 'katalyst' ), 'body' => __( 'Welche Arbeitsschritte lassen sich sinnvoll entlasten — und wo ist menschliche Expertise unverzichtbar?', 'katalyst' ) ),
			array( 'label' => 'Q3', 'title' => __( 'Wie integriert man KI modular?', 'katalyst' ), 'body' => __( 'Welche Architektur ermöglicht eine hochschulweite, frei verfügbare Plattform, die mit bestehenden Systemen zusammenarbeitet?', 'katalyst' ) ),
			array( 'label' => 'Q4', 'title' => __( 'Wie bleibt Lernen selbstbestimmt?', 'katalyst' ), 'body' => __( 'Wie unterstützen wir Studierende so, dass Eigenständigkeit und kritisches Denken gestärkt — nicht ersetzt — werden?', 'katalyst' ) ),
		),
		'news'       => array(
			'featured' => array( 'date' => __( '12. März 2026 · News', 'katalyst' ), 'title' => __( 'Pilotphase startet an der Hochschule Kempten', 'katalyst' ), 'body' => __( 'Die ersten drei Komponenten gehen in einem begleiteten Pilotversuch an den Start — mit Studierenden und Lehrenden aus mehreren Fakultäten.', 'katalyst' ) ),
			'items'    => array(
				array( 'date' => __( '04. März 2026 · Blog', 'katalyst' ), 'title' => __( 'Was fair geprüft werden kann', 'katalyst' ) ),
				array( 'date' => __( '26. Feb 2026 · Event', 'katalyst' ), 'title' => __( 'Fachtag KI in der Lehre', 'katalyst' ) ),
				array( 'date' => __( '14. Feb 2026 · Publikation', 'katalyst' ), 'title' => __( 'Whitepaper v1 veröffentlicht', 'katalyst' ) ),
				array( 'date' => __( '31. Jan 2026 · News', 'katalyst' ), 'title' => __( 'Kick-off Konsortium', 'katalyst' ) ),
				array( 'date' => __( '15. Jan 2026 · Blog', 'katalyst' ), 'title' => __( 'Was „modular“ eigentlich heißt', 'katalyst' ) ),
				array( 'date' => __( '20. Dez 2025 · News', 'katalyst' ), 'title' => __( 'Projektstart KATALYST', 'katalyst' ) ),
			),
		),
		'partners'   => array( 'HS Kempten', __( 'Partner-Logo', 'katalyst' ), __( 'Partner-Logo', 'katalyst' ), __( 'Partner-Logo', 'katalyst' ), __( 'Partner-Logo', 'katalyst' ) ),
		'contact'    => array(
			'lead'  => __( 'Austausch, Adoption, Presse — wir freuen uns auf Ihre Nachricht.', 'katalyst' ),
			'lines' => array(
				array( 'marker' => 'b', 'text' => 'projekt@katalyst-education.de', 'label' => __( 'Allgemein', 'katalyst' ) ),
				array( 'marker' => 'g', 'text' => 'adoption@katalyst-education.de', 'label' => __( 'Hochschulen', 'katalyst' ) ),
				array( 'marker' => 'n', 'text' => 'presse@katalyst-education.de', 'label' => __( 'Presse', 'katalyst' ) ),
				array( 'marker' => 'b', 'text' => __( 'Hochschule Kempten · Bahnhofstr. 61 · 87435 Kempten', 'katalyst' ), 'label' => __( 'Adresse', 'katalyst' ) ),
			),
		),
		'footer'     => array(
			'text'  => __( 'Hochschullehre mit generativer KI. Nutzbar, fair, zukunftsfähig. Ein Forschungsprojekt der Hochschule Kempten.', 'katalyst' ),
			'legal' => array( __( 'Impressum', 'katalyst' ), __( 'Datenschutz', 'katalyst' ), __( 'Barrierefreiheit', 'katalyst' ) ),
		),
	);
}
