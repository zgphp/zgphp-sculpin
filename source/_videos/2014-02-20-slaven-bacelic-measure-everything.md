---
title: Slaven Bacelić - Measure (almost) everything with statsd and Graphite
archive_id: "ZgPHPMeasurealmostEverythingWithStatsdAndGraphite"
---

"Having realtime overview of critical metrics can help you to detect signs of problems early and minimize their impact" - said Slaven Bacelic on one ZgPHP drinkup and was left with no choice but to speak about it on ZgPHP meetup.

With two simple and powerful tools, statsd and Graphite, you can measure anything at any point of you application without breaking it and with a very minor performance penalty (statsd uses non-blocking UDP communication). Collected metrics can be visualized through Graphite's web interfaces or exposed in various formats (JSON, CSV, SVG) for external graphing, analysis or monitoring.
