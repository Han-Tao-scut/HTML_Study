<?php $pageTitle = 'Reaserch Article'; ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main class="article-main">
        <section class="article-summary">
            <p>Manuscript</p>
            <h2>Functional streamlining and selective enrichment of bile-acid-associated carrier ecology in the
                centenarian gut microbiome</h2>
        </section>

        <div class="article-layout">
            <aside class="card article-toc">
                <h2>Content</h2>
                <ul>
                    <li class="toc-level-2">
                        <a href="#abstract">Abstract</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#introduction">Introduction</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#results">Results</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#dataset-construction-and-quality-control-overview">Dataset construction and
                            quality-control overview</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#centenarian-gut-microbiomes-show-reduced-species-richness">Centenarian gut microbiomes
                            show reduced species richness</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#a-coverage-qualified-pathway-universe-enables-species-function-contribution-analysis">A
                            coverage-qualified pathway universe enables species-function contribution analysis</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#pathway-contribution-architecture-is-more-concentrated-in-centenarians">Pathway
                            contribution architecture is more concentrated in centenarians</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#functional-streamlining-is-robust-to-species-attribution-thresholds">Functional
                            streamlining is robust to species-attribution thresholds</a>
                    </li>
                    <li class="toc-level-3">
                        <a
                            href="#bile-acid-associated-candidate-carrier-ecology-is-selectively-enriched-in-centenarians">Bile-acid-associated
                            candidate carrier ecology is selectively enriched in centenarians</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#butyrate-producer-associated-ecology-is-depleted-in-centenarians">Butyrate-producer-associated
                            ecology is depleted in centenarians</a>
                    </li>
                    <li class="toc-level-3">
                        <a
                            href="#carrier-stratified-gene-family-signals-support-enrichment-of-candidate-ba-carrier-ecology">Carrier-stratified
                            gene-family signals support enrichment of candidate BA carrier ecology</a>
                    </li>
                    <li class="toc-level-3">
                        <a
                            href="#an-integrated-ecology-score-captures-a-streamlined-but-selectively-enriched-centenarian-profile">An
                            integrated ecology score captures a streamlined but selectively enriched centenarian
                            profile</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#discussion">Discussion</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#methods">Methods</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#study-design-and-data-source">Study design and data source</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#sample-inclusion-and-exclusion">Sample inclusion and exclusion</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#metagenomic-read-processing">Metagenomic read processing</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#quality-control-proxies">Quality-control proxies</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#species-level-ecological-metrics">Species-level ecological metrics</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#coverage-qualified-pathway-universe">Coverage-qualified pathway universe</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#species-pathway-contribution-architecture">Species-pathway contribution
                            architecture</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#sample-level-functional-streamlining-metrics">Sample-level functional streamlining
                            metrics</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#bile-acid-associated-candidate-carrier-taxa">Bile-acid-associated candidate carrier
                            taxa</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#butyrate-producer-taxa">Butyrate-producer taxa</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#bile-acid-carrier-taxon-stratified-gene-family-proxy">Bile-acid carrier
                            taxon-stratified gene-family proxy</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#integrated-indices">Integrated indices</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#statistical-analysis">Statistical analysis</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#data-availability">Data availability</a>
                    </li>
                    <li class="toc-level-3">
                        <a href="#code-availability">Code availability</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#supplementary-tables">Supplementary tables</a>
                    </li>
                    <li class="toc-level-2">
                        <a href="#references">References</a>
                    </li>
                </ul>
            </aside>

            <article class="card article-content">
                <h2 id="abstract">Abstract</h2>
                <p>Centenarians provide a natural setting for studying microbiome features associated with successful
                    ageing. Whether their gut ecosystems are globally more diverse and functionally redundant, or
                    instead reorganized into a more specialized late-life configuration, remains unresolved. Here we
                    reanalysed 208 public shotgun metagenomes from a Japanese cohort, comprising 103 centenarians and
                    105 older controls aged 85-89 years, using species-level profiling and HUMAnN-based
                    species-stratified pathway contribution analysis. Centenarian microbiomes had lower species richness
                    and a more concentrated pathway contribution architecture, with fewer contributor species per
                    pathway, lower contribution diversity and greater dominance of the leading contributor. These
                    features were captured by an increased functional streamlining score and were robust to sensitivity
                    analyses based on pathway attribution thresholds and gene-family mapping efficiency. Against this
                    globally streamlined background, bile-acid-associated candidate carrier taxa, including
                    <em>Alistipes</em>, <em>Odoribacter</em>, <em>Parabacteroides</em>, <em>Clostridium scindens</em>
                    and <em>Eggerthella lenta</em>, were selectively enriched and contributed higher taxon-stratified
                    gene-family signals. Canonical butyrate-producer-associated taxa were depleted. These findings
                    support a model in which the centenarian gut microbiome is not globally expanded or broadly more
                    redundant, but instead exhibits functional streamlining coupled to selective enrichment of candidate
                    bile-acid-associated carrier ecology. Because bile acids and targeted enzyme homologues were not
                    directly measured, the bile-acid-related results should be interpreted as ecological carrier proxies
                    rather than evidence of increased isoalloLCA biosynthesis.
                </p>
                <h2 id="introduction">Introduction</h2>
                <p>Extreme longevity offers a human model in which advanced chronological age is partly uncoupled from
                    the expected burden of age-associated disease. Centenarians and semi-supercentenarians often show
                    delayed onset of major chronic disorders and relative resistance to inflammatory and infectious
                    insults, although this phenotype is heterogeneous across individuals and cohorts [1,2]. The gut
                    microbiome is a plausible contributor to this state because it regulates nutrient metabolism,
                    mucosal immunity, microbial colonization resistance and host metabolic signalling [2,6]. Yet the
                    ecological organization of the centenarian gut microbiome remains incompletely defined.</p>
                <p>Several studies have shown that centenarians harbour microbial communities that differ from those of
                    younger adults and conventional older controls [3-7]. In the Japanese cohort reanalysed here,
                    metagenomic and metabolomic profiling revealed a distinctive secondary bile acid profile, including
                    increased isoLCA, 3-oxoLCA, alloLCA, 3-oxoalloLCA and isoalloLCA [7]. Culture and mouse experiments
                    further implicated Odoribacteraceae and related bacterial taxa in isoalloLCA production and showed
                    that isoalloLCA can inhibit Gram-positive pathobionts, including <em>Clostridioides difficile</em>
                    and vancomycin-resistant <em>Enterococcus faecium</em> [7]. These observations align with broader
                    work showing that intestinal bacteria reshape bile acid pools and that secondary bile acids can
                    influence pathogen resistance and mucosal immunity [8-16].</p>
                <p>Most ageing-microbiome analyses, however, remain centred on taxonomic composition, alpha and beta
                    diversity, or the differential abundance of individual taxa and pathways. Such analyses identify
                    which organisms or functions change, but they do not resolve how microbial functions are distributed
                    across species. A pathway may be broadly shared across many taxa, indicating a distributed
                    contribution architecture, or it may be carried mainly by a small number of dominant contributors.
                    This distinction is central to the concept of functional redundancy, which has been proposed to
                    stabilize microbiome function despite taxonomic turnover [20,21].</p>
                <p>We therefore reframed the Japanese centenarian dataset around two competing ecological models. In the
                    first, the centenarian gut microbiome is globally expanded and more functionally redundant. In the
                    second, it is globally streamlined, with selected functional niches retained or enriched. Using
                    MetaPhlAn and HUMAnN profiles [22,23], we reconstructed species-level ecology and species-stratified
                    pathway contribution architecture, then evaluated candidate bile-acid-associated carrier taxa and
                    butyrate-producer-associated taxa (Fig. 1). The results support the second model: centenarian
                    microbiomes showed species-level simplification and concentrated pathway contribution architecture,
                    whereas candidate bile-acid-associated carrier ecology was selectively enriched.</p>
                <figure class="article-figure"><a
                        href="article/figure/figure1_study_design/Figure1_study_design_conceptual_framework.png"><img
                            src="article/figure/figure1_study_design/Figure1_study_design_conceptual_framework.png"
                            alt="Study design and conceptual framework for centenarian gut microbiome functional streamlining."></a>
                </figure>
                <p><strong>Figure 1 | Study design and conceptual framework for centenarian gut microbiome functional
                        streamlining.</strong><br>(A) Cohort design comparing centenarians aged at least 100 years with
                    older controls aged 85-89 years. (B) Metagenomic workflow from raw reads to quality control,
                    host-read removal, MetaPhlAn species profiling, HUMAnN pathway and gene-family profiling, and joined
                    analysis tables. (C) Downstream analytical modules: species-level ecology, species-pathway
                    contribution architecture, candidate bile-acid-associated carrier ecology, and
                    butyrate-producer-associated taxa. (D) Competing models: global expansion/redundancy versus
                    functional streamlining with selective niche enrichment. (E) Working model in which centenarian gut
                    microbiomes show reduced species richness, concentrated pathway contribution architecture, enriched
                    candidate bile-acid carrier ecology and depleted butyrate-producer-associated balance.</p>
                <h2 id="results">Results</h2>
                <h3 id="dataset-construction-and-quality-control-overview">Dataset construction and quality-control
                    overview</h3>
                <p>We reanalysed publicly available shotgun metagenomic data from the Japanese centenarian cohort
                    deposited under BioProject PRJNA675598 [7]. After excluding antibiotic-exposed samples, low-input
                    sequencing records with SRA file size not exceeding 200 MB, and duplicate or longitudinal records,
                    the locked analytical manifest contained 208 stool metagenomes: 103 from centenarians aged at least
                    100 years and 105 from older controls aged 85-89 years.</p>
                <p>All downstream analyses were restricted to samples present in the metadata, MetaPhlAn species table,
                    HUMAnN unstratified pathway abundance table, HUMAnN stratified pathway abundance table, pathway
                    coverage table and gene-family table. No sample was lost during matrix intersection. Because
                    individual-level covariates, including sex, body mass index, medication, residence, batch and read
                    depth, were not available in the final analysis table, we used table-derived quality-control
                    proxies. GeneFamily_UNMAPPED_CPM was higher in centenarians than in older controls, whereas
                    Pathway_UNINTEGRATED_CPM was lower in centenarians. Core group comparisons were therefore evaluated
                    using both a primary group-only model and a sensitivity model adjusted for <span
                        class="tex-inline">\log(1 + \text{GeneFamily_UNMAPPED_CPM})</span> (Extended Data Fig. 1).</p>
                <figure class="article-figure"><a
                        href="article/figure/supplementary_figure1_profile_overview/ExtendedDataFigure1_MetaPhlAn_HUMAnN_profile_overview.png"><img
                            src="article/figure/supplementary_figure1_profile_overview/ExtendedDataFigure1_MetaPhlAn_HUMAnN_profile_overview.png"
                            alt="Species-level ecological simplification in centenarian gut microbiomes"></a>
                </figure>
                <p><strong>Extended Data Figure 1 | MetaPhlAn and HUMAnN profiling overview before downstream ecological
                        analysis.</strong><br>(A) MetaPhlAn species prevalence-abundance landscape. (B) HUMAnN pathway
                    prevalence-abundance landscape and coverage-qualified pathway universe. (C) HUMAnN technical
                    annotation metrics. (D) Sample-level pathway coverage and universe-pass counts. (E) Stratified
                    Pathway|Species contribution availability and AttributedFraction distribution.</p>
                <h3 id="centenarian-gut-microbiomes-show-reduced-species-richness">Centenarian gut microbiomes show
                    reduced species richness</h3>
                <p>We first tested whether centenarian gut communities showed species-level expansion or simplification.
                    MetaPhlAn species profiles revealed lower richness in centenarians than in older controls (Fig. 2a).
                    Mean species richness was 87.43 in centenarians and 98.68 in older controls, with corresponding
                    medians of 85.00 and 98.00. In the primary linear model, centenarian status was associated with
                    11.25 fewer detected species (<span class="tex-inline">P = 6.51 \times 10^{-4}</span>).</p>
                <p>The richness difference remained after adjustment for gene-family mapping efficiency. In the model
                    including <span class="tex-inline">\log(1 + \text{GeneFamily_UNMAPPED_CPM})</span>, the estimated
                    difference was <span class="tex-inline">-12.34</span> species (95% CI, <span
                        class="tex-inline">-19.04</span> to <span class="tex-inline">-5.65</span>; <span
                        class="tex-inline">P = 3.49 \times 10^{-4}</span>). Thus, reduced species richness was not
                    explained by differences in gene-family unmapped fraction.</p>
                <p>Other species-level metrics provided weaker but directionally consistent evidence of simplification
                    (Fig. 2b-d). Effective species number was lower in centenarians than in older controls, although the
                    primary model did not reach significance (21.78 versus 23.40; estimated difference, <span
                        class="tex-inline">-1.62</span>; <span class="tex-inline">P = 0.149</span>). After adjustment
                    for <span class="tex-inline">\log(1 + \text{GeneFamily_UNMAPPED_CPM})</span>, effective species
                    number was significantly lower in centenarians (estimated difference, <span
                        class="tex-inline">-2.83</span>; 95% CI, <span class="tex-inline">-5.08</span> to <span
                        class="tex-inline">-0.59</span>; <span class="tex-inline">P = 0.0134</span>). Dominance and the
                    top-five species fraction did not differ significantly between groups, indicating that the richness
                    difference was not simply a single-taxon dominance effect.</p>
                <p>Composite ecological contraction supported the same interpretation. SpeciesContractionScore was
                    higher in centenarians after adjustment for gene-family unmapped fraction (estimated difference,
                    <span class="tex-inline">1.27</span>; 95% CI, <span class="tex-inline">0.30</span> to <span
                        class="tex-inline">2.24</span>; <span class="tex-inline">P = 0.0103</span>). We therefore
                    treated reduced species richness as the most robust first-level ecological signature of the
                    centenarian microbiome (Fig. 2e).
                </p>
                <figure class="article-figure"><a
                        href="article/figure/figure2_species_simplification/Figure2_species_level_ecological_simplification.png"><img
                            src="article/figure/figure2_species_simplification/Figure2_species_level_ecological_simplification.png"
                            alt=""></a></figure>
                <p><strong>Figure 2 | Species-level ecological simplification in centenarian gut
                        microbiomes.</strong><br>(A) Species richness based on MetaPhlAn species profiles. (B) Effective
                    species number derived from Shannon diversity. (C) Dominance and top-five species fraction. (D)
                    SpeciesContractionScore. (E) Representative species-level shifts between centenarians and older
                    controls; point size indicates detection rate and colour indicates mean relative abundance.</p>
                <h3 id="a-coverage-qualified-pathway-universe-enables-species-function-contribution-analysis">A
                    coverage-qualified pathway universe enables species-function contribution analysis</h3>
                <p>We next constructed a coverage-qualified pathway universe to evaluate whether species-level
                    simplification was accompanied by altered functional contribution architecture. HUMAnN pathway
                    abundance and coverage tables shared 523 pathway features after technical alignment [22,23]. After
                    excluding HUMAnN technical rows and low-prevalence pathways, 88 coverage-qualified pathways passed
                    the primary criteria of pathway coverage <span class="tex-inline">\geq 0.5</span>, unstratified
                    pathway CPM <span class="tex-inline">&gt; 0</span> and joint prevalence <span
                        class="tex-inline">\geq 20\%</span> (Extended Data Fig. 1b-d).</p>
                <p>Centenarians had a slightly lower number of coverage-qualified pathways per sample than older
                    controls. The mean number of universe pathways passing sample-level criteria was 69.27 in
                    centenarians and 71.13 in older controls, with medians of 71.00 and 72.00, respectively. Because
                    this difference could influence downstream contribution metrics, we tracked the number of pathways
                    with calculable contribution architecture in subsequent analyses.</p>
                <h3 id="pathway-contribution-architecture-is-more-concentrated-in-centenarians">Pathway contribution
                    architecture is more concentrated in centenarians</h3>
                <p>Using the HUMAnN stratified Pathway|Species table, we quantified how many species contributed to each
                    pathway and whether those contributions were distributed or dominated by a leading taxon. Across the
                    88 coverage-qualified pathways, the effective-edge filtering procedure yielded 175,849
                    species-pathway edges and 14,594 sample-pathway contribution observations. The primary analysis used
                    observations with AttributedFraction <span class="tex-inline">\geq 0.5</span> to reduce the
                    influence of incomplete species attribution (Extended Data Fig. 1e).</p>
                <p>Centenarian samples showed a more concentrated pathway contribution architecture than older controls
                    (Fig. 3a-d). MeanContributorRichness was lower in centenarians (12.52 versus 13.76; medians, 12.53
                    versus 14.20; estimated difference, <span class="tex-inline">-1.24</span>; <span
                        class="tex-inline">P = 4.40 \times 10^{-4}</span>). MeanFRI was also lower in centenarians
                    (0.770 versus 0.830; medians, 0.797 versus 0.858; estimated difference, <span
                        class="tex-inline">-0.060</span>; <span class="tex-inline">P = 2.19 \times 10^{-5}</span>).
                    Conversely, MeanTopContributorFraction was higher in centenarians (0.371 versus 0.289; medians,
                    0.359 versus 0.259; estimated difference, <span class="tex-inline">0.0815</span>; <span
                        class="tex-inline">P = 2.57 \times 10^{-6}</span>).</p>
                <p>These changes were summarized by FunctionalStreamliningScore, which was markedly higher in
                    centenarians than in older controls (0.865 versus <span class="tex-inline">-0.848</span>; medians,
                    0.394 versus <span class="tex-inline">-1.552</span>; estimated difference, <span
                        class="tex-inline">1.713</span>; <span class="tex-inline">P = 1.42 \times 10^{-5}</span>).
                    NPathwaysWithContributionMetrics did not differ significantly between groups (58.40 versus 57.82;
                    estimated difference, <span class="tex-inline">0.579</span>; <span class="tex-inline">P =
                        0.546</span>), indicating that the streamlining signal was not caused by fewer analysable
                    pathways in centenarians.</p>
                <p>After adjustment for <span class="tex-inline">\log(1 + \text{GeneFamily_UNMAPPED_CPM})</span>, all
                    core contribution architecture metrics retained the same direction. MeanContributorRichness remained
                    lower in centenarians (estimated difference, <span class="tex-inline">-1.33</span>; <span
                        class="tex-inline">P = 2.92 \times 10^{-4}</span>), MeanFRI remained lower (estimated
                    difference, <span class="tex-inline">-0.0630</span>; <span class="tex-inline">P = 4.69 \times
                        10^{-5}</span>), MeanTopContributorFraction remained higher (estimated difference, <span
                        class="tex-inline">0.0815</span>; <span class="tex-inline">P = 1.06 \times 10^{-5}</span>) and
                    FunctionalStreamliningScore remained higher (estimated difference, <span
                        class="tex-inline">1.776</span>; <span class="tex-inline">P = 2.74 \times 10^{-5}</span>). These
                    results indicate that centenarian pathway functions are, on average, carried by fewer and more
                    dominant contributor species.</p>
                <h3 id="functional-streamlining-is-robust-to-species-attribution-thresholds">Functional streamlining is
                    robust to species-attribution thresholds</h3>
                <p>To test whether streamlining reflected incomplete HUMAnN species attribution, we repeated the
                    contribution architecture analysis across three AttributedFraction thresholds: 0.0, 0.5 and 0.7. At
                    all thresholds, centenarians consistently showed lower MeanContributorRichness, lower MeanFRI,
                    higher MeanTopContributorFraction and higher FunctionalStreamliningScore (Fig. 3e).</p>
                <p>At AttributedFraction <span class="tex-inline">\geq 0.0</span>, MeanContributorRichness was lower in
                    centenarians (estimated difference, <span class="tex-inline">-1.4284</span>; <span
                        class="tex-inline">q = 1.08 \times 10^{-4}</span>), MeanFRI was lower (estimated difference,
                    <span class="tex-inline">-0.0567</span>; <span class="tex-inline">q = 3.4 \times 10^{-5}</span>),
                    MeanTopContributorFraction was higher (estimated difference, <span class="tex-inline">0.0753</span>;
                    <span class="tex-inline">q = 1.0 \times 10^{-5}</span>) and FunctionalStreamliningScore was higher
                    (estimated difference, <span class="tex-inline">1.7469</span>; <span class="tex-inline">q = 1.2
                        \times 10^{-5}</span>). The same pattern was observed at the primary threshold of
                    AttributedFraction <span class="tex-inline">\geq 0.5</span> and remained evident at
                    AttributedFraction <span class="tex-inline">\geq 0.7</span>.
                </p>
                <p>Under the high-attribution threshold of 0.7, centenarians still showed lower MeanContributorRichness
                    (estimated difference, <span class="tex-inline">-1.7181</span>; <span class="tex-inline">q = 4.47
                        \times 10^{-4}</span>), lower MeanFRI (estimated difference, <span
                        class="tex-inline">-0.0552</span>; <span class="tex-inline">q = 1.08 \times 10^{-4}</span>),
                    higher MeanTopContributorFraction (estimated difference, <span class="tex-inline">0.0800</span>;
                    <span class="tex-inline">q = 1.2 \times 10^{-5}</span>) and higher FunctionalStreamliningScore
                    (estimated difference, <span class="tex-inline">1.6346</span>; <span class="tex-inline">q = 3.4
                        \times 10^{-5}</span>). Moreover, the number of pathways with contribution metrics at
                    AttributedFraction <span class="tex-inline">\geq 0.7</span> was not lower in centenarians.
                    Functional streamlining was therefore a stable feature rather than an artefact of incomplete
                    taxonomic attribution.
                </p>
                <figure class="article-figure"><a
                        href="article/figure/figure3_functional_streamlining/Figure3_functional_streamlining_pathway_contribution_architecture.png"><img
                            src="article/figure/figure3_functional_streamlining/Figure3_functional_streamlining_pathway_contribution_architecture.png"
                            alt="Functional streamlining of pathway contribution architecture in centenarian gut microbiomes."></a>
                </figure>
                <p><strong>Figure 3 | Functional streamlining of pathway contribution architecture.</strong>
                    (A) MeanContributorRichness across coverage-qualified pathways. (B) MeanFRI, calculated as <span
                        class="tex-inline">1 - \sum p_i^2</span> for the relative contribution of each species to an
                    attributed pathway. (C) MeanTopContributorFraction. (D) FunctionalStreamliningScore. (E) Sensitivity
                    of group effects across AttributedFraction thresholds of 0.0, 0.5 and 0.7.</p>
                <h3 id="bile-acid-associated-candidate-carrier-ecology-is-selectively-enriched-in-centenarians">
                    Bile-acid-associated candidate carrier ecology is selectively enriched in centenarians</h3>
                <p>We next asked whether specific functional ecological niches were retained or enriched against the
                    background of species-level simplification and pathway streamlining. Given the previously reported
                    enrichment of unusual secondary bile acids in Japanese centenarians [7], and the established role of
                    gut bacteria in bile acid biotransformation [8-11], we focused on a predefined set of
                    bile-acid-associated candidate carrier taxa: <em>Alistipes</em>, <em>Odoribacter</em>,
                    <em>Parabacteroides</em>, <em>Clostridium scindens</em> and <em>Eggerthella lenta</em>. This
                    analysis was designed as a carrier-ecology proxy and was not intended to quantify bile acid
                    metabolite levels or specific bile-acid enzyme genes.
                </p>
                <p>Candidate BA carrier taxa were enriched in centenarians across multiple species-level metrics (Fig.
                    4a-c). BA_Carrier_SumAbundance was higher in centenarians than in older controls (15.89 versus 5.49;
                    medians, 11.93 versus 3.99; estimated difference, <span class="tex-inline">10.40</span>; <span
                        class="tex-inline">P = 5.46 \times 10^{-13}</span>). BA_Carrier_Richness was also higher in
                    centenarians (9.01 versus 7.30; medians, 9.00 versus 7.00; estimated difference, <span
                        class="tex-inline">1.71</span>; <span class="tex-inline">P = 6.40 \times 10^{-6}</span>). The
                    log-ratio BA_Carrier_Balance was increased in centenarians (estimated difference, <span
                        class="tex-inline">1.05</span>; <span class="tex-inline">P = 7.43 \times 10^{-13}</span>).</p>
                <p>These effects remained significant after adjustment for gene-family unmapped fraction.
                    BA_Carrier_SumAbundance remained higher in centenarians (adjusted estimated difference, <span
                        class="tex-inline">8.83</span>; <span class="tex-inline">P = 1.64 \times 10^{-11}</span>), as
                    did BA_Carrier_Richness (adjusted estimated difference, <span class="tex-inline">1.27</span>; <span
                        class="tex-inline">P = 9.28 \times 10^{-4}</span>) and BA_Carrier_Balance (adjusted estimated
                    difference, <span class="tex-inline">0.896</span>; <span class="tex-inline">P = 6.16 \times
                        10^{-10}</span>).</p>
                <p>The enrichment was distributed across several representative carrier taxa. <em>Alistipes
                        finegoldii</em>, <em>Alistipes putredinis</em>, <em>Clostridium scindens</em>, <em>Eggerthella
                        lenta</em>, <em>Parabacteroides distasonis</em> and <em>Parabacteroides merdae</em> all showed
                    higher mean abundance in centenarians than in older controls. <em>Clostridium scindens</em>, a
                    species previously linked to bile acid-mediated <em>C. difficile</em> resistance [12], showed a
                    particularly strong carrier signal.</p>
                <h3 id="butyrate-producer-associated-ecology-is-depleted-in-centenarians">Butyrate-producer-associated
                    ecology is depleted in centenarians</h3>
                <p>We then evaluated whether BA carrier enrichment occurred alongside changes in traditional
                    butyrate-producer-associated taxa. The predefined butyrate-producer set included
                    <em>Faecalibacterium prausnitzii</em>, <em>Eubacterium rectale</em> and <em>Roseburia
                        intestinalis</em>. Butyrate and other short-chain fatty acids can support colonic regulatory
                    T-cell homeostasis and intestinal immune regulation [17-19], but no short-chain fatty acid
                    metabolomics were available in this reanalysis.
                </p>
                <p>ButyrateProducer_SumAbundance was lower in centenarians than in older controls (3.26 versus 8.36;
                    medians, 1.24 versus 6.61; estimated difference, <span class="tex-inline">-5.10</span>; <span
                        class="tex-inline">P = 5.51 \times 10^{-9}</span>). ButyrateProducer_Richness was also lower in
                    centenarians (1.41 versus 2.14; medians, 1.00 versus 2.00; estimated difference, <span
                        class="tex-inline">-0.735</span>; <span class="tex-inline">P = 4.17 \times 10^{-9}</span>).
                    Consistently, ButyrateDepletionBalance was lower in centenarians (estimated difference, <span
                        class="tex-inline">-3.11</span>; <span class="tex-inline">P = 7.67 \times 10^{-7}</span>).
                    BA_to_Butyrate_Balance was higher in centenarians, reflecting the combined pattern of BA carrier
                    enrichment and butyrate-producer depletion (Fig. 4d,e).</p>
                <p>At the taxon level, <em>Eubacterium rectale</em> and <em>Faecalibacterium prausnitzii</em> showed
                    lower mean abundance and detection rate in centenarians than in older controls, whereas
                    <em>Roseburia intestinalis</em> showed a weaker downward trend. These results should be interpreted
                    as depletion of butyrate-producer-associated taxa rather than direct evidence of lower faecal
                    butyrate concentration.
                </p>
                <figure class="article-figure"><a
                        href="article/figure/figure4_ba_butyrate_taxa/Figure4_ba_carrier_ecology_butyrate_taxa_depletion.png"><img
                            src="article/figure/figure4_ba_butyrate_taxa/Figure4_ba_carrier_ecology_butyrate_taxa_depletion.png"
                            alt="Selective enrichment of bile-acid-associated carrier ecology and depletion of butyrate-associated taxa."></a>
                </figure>
                <p><strong>Figure 4 | Selective enrichment of bile-acid-associated carrier ecology and depletion of
                        butyrate-associated taxa.</strong><br>(A) BA_Carrier_Balance. (B) BA_Carrier_Richness and
                    BA_Carrier_SumAbundance. (C) Representative candidate BA carrier taxa, including <em>Alistipes
                        finegoldii</em>, <em>Alistipes putredinis</em>, <em>Clostridium scindens</em>, <em>Eggerthella
                        lenta</em>, <em>Parabacteroides distasonis</em> and <em>Parabacteroides merdae</em>. (D)
                    ButyrateProducer_SumAbundance and ButyrateProducer_Richness. (E) ButyrateDepletionBalance.</p>
                <h3 id="carrier-stratified-gene-family-signals-support-enrichment-of-candidate-ba-carrier-ecology">
                    Carrier-stratified gene-family signals support enrichment of candidate BA carrier ecology</h3>
                <p>To evaluate whether enriched carrier taxa also contributed more functional gene-family signal, we
                    extracted HUMAnN stratified UniRef90 gene-family rows attributed to the predefined BA carrier taxa.
                    This screen included 6,753,518 total gene-family rows, 4,074,907 stratified rows and 90,989
                    BA-carrier-matched rows, with 24 BA carrier taxa detected in the gene-family table.</p>
                <p>BA_Carrier_TaxonStratifiedGeneFamilyCPMSum was higher in centenarians than in older controls
                    (80,437.08 versus 36,733.49 CPM; medians, 68,411.87 versus 30,782.65 CPM; estimated difference,
                    <span class="tex-inline">43{,}703.59</span>; <span class="tex-inline">P = 1.16 \times
                        10^{-12}</span>). The log-transformed version of this metric was also higher in centenarians
                    (estimated difference, <span class="tex-inline">0.678</span>; <span class="tex-inline">P = 1.90
                        \times 10^{-9}</span>). BA_Carrier_TaxonStratifiedGeneFamilyDetectedCount was higher in
                    centenarians (20,542.92 versus 14,932.01; estimated difference, <span
                        class="tex-inline">5{,}610.91</span>; <span class="tex-inline">P = 3.84 \times 10^{-8}</span>),
                    as was BA_Carrier_DistinctGeneFamilyDetectedCount (18,042.88 versus 13,455.68; estimated difference,
                    <span class="tex-inline">4{,}587.21</span>; <span class="tex-inline">P = 1.94 \times 10^{-7}</span>)
                    (Fig. 5a,b).
                </p>
                <p>These differences persisted after adjustment for <span class="tex-inline">\log(1 +
                        \text{GeneFamily_UNMAPPED_CPM})</span>. The adjusted estimated difference for
                    BA_Carrier_TaxonStratifiedGeneFamilyCPMSum was <span class="tex-inline">40{,}218.17</span> CPM
                    (<span class="tex-inline">P = 2.50 \times 10^{-11}</span>); the adjusted estimated difference for
                    BA_Carrier_TaxonStratifiedGeneFamilyDetectedCount was <span class="tex-inline">5{,}232.29</span>
                    (<span class="tex-inline">P = 5.76 \times 10^{-7}</span>); and the adjusted estimated difference for
                    BA_Carrier_DistinctGeneFamilyDetectedCount was <span class="tex-inline">4{,}361.82</span> (<span
                        class="tex-inline">P = 1.51 \times 10^{-6}</span>).</p>
                <p>Taxon-level gene-family contributions were especially notable for <em>Parabacteroides
                        distasonis</em>, <em>Alistipes finegoldii</em>, <em>Parabacteroides merdae</em>, <em>Alistipes
                        putredinis</em>, <em>Clostridium scindens</em> and <em>Eggerthella lenta</em> (Fig. 5c,d). These
                    results support enrichment of candidate BA carrier taxon-stratified gene-family signals in
                    centenarians. However, because this analysis was not a targeted homolog screen, these metrics should
                    not be interpreted as direct evidence for increased 5α-reductase, 3β-hydroxysteroid dehydrogenase,
                    5β-reductase, bai genes or isoalloLCA biosynthetic capacity.</p>
                <figure class="article-figure"><a
                        href="article/figure/figure5_ba_carrier_genefamily_proxy/Figure5_enhanced_taxon_stratified_ba_carrier_genefamily_proxy.png"><img
                            src="article/figure/figure5_ba_carrier_genefamily_proxy/Figure5_enhanced_taxon_stratified_ba_carrier_genefamily_proxy.png"
                            alt="Enhanced taxon-stratified gene-family proxy of candidate bile-acid-associated carrier taxa.**"></a>
                </figure>
                <p><strong>Figure 5 | Enhanced taxon-stratified gene-family proxy of candidate bile-acid-associated
                        carrier taxa.</strong><br>(A) BA_Carrier_TaxonStratifiedGeneFamilyCPMSum. (B)
                    BA_Carrier_TaxonStratifiedGeneFamilyDetectedCount. (C) Representative carrier taxa contributing to
                    the taxon-stratified gene-family signal. (D) Association between BA_Carrier_Balance and
                    BA_Carrier_TaxonStratifiedGeneFamilyCPMSum. These metrics are HUMAnN taxon-stratified gene-family
                    proxies and are not targeted measurements of 5AR, 3β-HSDH, 5BR, bai genes or isoalloLCA
                    biosynthesis.</p>
                <h3
                    id="an-integrated-ecology-score-captures-a-streamlined-but-selectively-enriched-centenarian-profile">
                    An integrated ecology score captures a streamlined but selectively enriched centenarian profile</h3>
                <p>Finally, we integrated the major ecological axes into a sample-level summary framework. The
                    integrated model was designed to capture the joint pattern of species-level simplification,
                    functional streamlining, BA carrier enrichment and butyrate-producer depletion. Consistent with the
                    individual analyses, IntegratedLongevityEcologyScore was higher in centenarians than in older
                    controls (<span class="tex-inline">1.398</span> versus <span class="tex-inline">-1.371</span>;
                    medians, <span class="tex-inline">1.272</span> versus <span class="tex-inline">-1.526</span>;
                    estimated difference, <span class="tex-inline">2.770</span>; <span class="tex-inline">P = 9.62
                        \times 10^{-17}</span>) (Fig. 6a).</p>
                <p>This integrated pattern indicates that the centenarian gut microbiome is not globally more diverse,
                    more redundant or more evenly distributed across functional contributors. Instead, centenarians show
                    a coherent ecological profile characterized by reduced species richness, fewer pathway contributors,
                    lower contribution diversity, greater top-contributor dominance, selective enrichment of
                    bile-acid-associated candidate carrier taxa and depletion of butyrate-producer-associated taxa (Fig.
                    6b,c).</p>
                <figure class="article-figure"><a
                        href="article/figure/figure6_integrated_longevity_ecology_model/Figure6_integrated_longevity_ecology_model.png"><img
                            src="article/figure/figure6_integrated_longevity_ecology_model/Figure6_integrated_longevity_ecology_model.png"
                            alt="Figure 6 | Integrated longevity ecology model linking global streamlining with selective carrier-niche enrichment."></a>

                </figure>
                <p><strong>Figure 6 | Integrated longevity ecology model linking global streamlining with selective
                        carrier-niche enrichment.</strong><br>(A) SpeciesSimplificationIndex, BACarrierEcologyIndex,
                    ButyrateDepletionIndex and IntegratedLongevityEcologyScore. (B) Spearman correlation network among
                    core ecological metrics. (C) Final working model of the centenarian gut ecological state.</p>
                <h2 id="discussion">Discussion</h2>
                <p>This reanalysis suggests that the Japanese centenarian gut microbiome is not characterized by global
                    ecological expansion or broadly increased functional redundancy. Instead, centenarians showed
                    reduced species richness, fewer species contributors per pathway, lower contribution diversity and
                    greater top-contributor dominance. These findings support a model of functional streamlining, in
                    which common pathway functions are carried by fewer and more dominant taxa.</p>
                <p>The result revises a common assumption in longevity-microbiome interpretation. A healthy or
                    long-lived host state is often expected to require greater microbial diversity or higher global
                    functional redundancy. In this dataset, that expectation was not supported at the global level. The
                    centenarian microbiome instead resembled a constrained late-life ecological configuration: broad
                    taxonomic and functional sharing was reduced, whereas selected niches remained enriched. This
                    interpretation is consistent with the broader view that redundancy can contribute to microbiome
                    stability [20,21], but it shows that exceptional longevity need not coincide with higher redundancy
                    across all pathways.</p>
                <p>The most prominent selectively enriched niche was the bile-acid-associated candidate carrier ecology.
                    Candidate carrier taxa were enriched in centenarians, and their taxon-stratified gene-family signal
                    was also higher. This finding is concordant with the original Japanese cohort report, which
                    identified distinctive secondary bile acids and bile-acid-metabolizing bacteria in centenarians [7].
                    It is also biologically plausible in light of work showing that gut bacteria transform bile acids
                    [8-11], that secondary bile acids can restrict <em>C. difficile</em> and other Gram-positive
                    pathogens [12,13], and that bile acid metabolites can regulate mucosal immune cell differentiation
                    [14-16]. However, the present study did not measure bile acids or perform targeted homolog
                    screening. The results therefore indicate enrichment of candidate carrier ecology, not increased
                    isoalloLCA production or increased abundance of 5α-reductase, 3β-hydroxysteroid dehydrogenase,
                    5β-reductase or bai genes.</p>
                <p>In parallel, butyrate-producer-associated taxa, including <em>Faecalibacterium prausnitzii</em>,
                    <em>Eubacterium rectale</em> and <em>Roseburia intestinalis</em>, were depleted in centenarians.
                    This pattern suggests that the centenarian microbiome is not simply a youth-like, fibre-fermenting
                    configuration. Instead, extreme old age may involve ecological rebalancing: canonical
                    butyrate-producer-associated taxa decline, whereas bile-acid-associated candidate carriers are
                    selectively retained or enriched. Because short-chain fatty acids were not measured, this result
                    should not be interpreted as evidence of lower faecal butyrate concentration.
                </p>
                <p>The species-pathway contribution framework used here adds information beyond conventional
                    differential abundance analysis. It shows not only which taxa or functions differ between groups,
                    but also how pathway functions are distributed across contributing species. The observation that
                    centenarian pathways are more dominated by fewer contributors indicates that functional
                    organization, not merely taxonomic composition, changes in extreme old age.</p>
                <p>This study has important limitations. It is a cross-sectional reanalysis and cannot establish
                    causality between microbiome structure and longevity. Individual-level covariates such as diet,
                    medication, residence, frailty, batch and sequencing depth were unavailable in the final modelling
                    table. Relative-abundance metagenomics cannot determine absolute microbial biomass. HUMAnN species
                    attribution is incomplete for some pathways, although the main streamlining signal was robust across
                    AttributedFraction thresholds. Finally, the bile-acid-related analyses were based on candidate
                    carrier taxa and stratified gene-family proxies rather than metabolomics or targeted enzyme
                    profiling.</p>
                <p>Future studies should combine longitudinal sampling, absolute microbial load measurement, bile acid
                    metabolomics, short-chain fatty acid profiling and targeted detection of bile acid metabolic
                    enzymes. These data will be needed to determine whether the carrier ecology observed here
                    corresponds to increased biochemical capacity and whether functional streamlining precedes,
                    accompanies or follows exceptional longevity.</p>
                <p>In summary, this study supports a model in which the centenarian gut microbiome is globally
                    streamlined but selectively enriched for bile-acid-associated candidate carrier ecology. Extreme
                    longevity is therefore not associated with uniformly greater microbial diversity or functional
                    redundancy in this dataset, but with a more concentrated ecological architecture and selective
                    preservation of specific functional niches.</p>
                <h2 id="methods">Methods</h2>
                <h3 id="study-design-and-data-source">Study design and data source</h3>
                <p>This study was a public dataset reanalysis of shotgun metagenomic profiles from the Japanese
                    centenarian gut microbiome cohort [7]. No new human participants were recruited, and no new
                    biological specimens were collected. Raw sequencing data were obtained from BioProject accession
                    PRJNA675598. The primary analysis compared centenarians aged at least 100 years with older controls
                    aged 85-89 years. The final dataset consisted of 208 stool metagenomes, including 103 centenarian
                    samples and 105 older-control samples. Sample composition and group assignment are provided in
                    Supplementary Table 1.</p>
                <h3 id="sample-inclusion-and-exclusion">Sample inclusion and exclusion</h3>
                <p>Samples were retained according to a predefined sample manifest. We excluded samples from individuals
                    who had received antibiotics, low-input sequencing records with an SRA file size of 200 MB or less,
                    and duplicate or longitudinal records. When duplicate or longitudinal records were present, only one
                    eligible sample per individual was retained. The final dataset was restricted to the locked
                    intersection of samples available in the metadata table, MetaPhlAn species table, HUMAnN
                    unstratified pathway abundance table, HUMAnN stratified pathway abundance table, HUMAnN pathway
                    coverage table and HUMAnN gene-family table. No additional individual-level covariates, including
                    sex, body mass index, medication, living status, batch or read depth, were available for the final
                    statistical models.</p>
                <h3 id="metagenomic-read-processing">Metagenomic read processing</h3>
                <p>Raw SRA files were converted to FASTQ format and processed using a standardized metagenomic workflow.
                    Paired-end reads were quality-filtered and adapter-trimmed with fastp v1.3.2 [24]. Host-derived
                    reads were removed using KneadData v0.12.4 with Bowtie2 v2.5.5 against the hg39 human genome
                    database. Cleaned paired reads were concatenated for taxonomic and functional profiling.
                    Species-level taxonomic profiles were generated using MetaPhlAn v3.1.0 with the
                    v31_CHOCOPhlAn_201901 marker database. Functional profiling was performed using HUMAnN v3.6 with the
                    ChocoPhlAn v201901_v31 nucleotide database and the UniRef90 v201901b_full protein database [22,23].
                    HUMAnN pathway and gene-family abundance tables were renormalized to copies per million (CPM).
                    Stratified and unstratified pathway abundance tables were generated using HUMAnN utilities and
                    joined across samples. Downstream analyses were performed in Python v3.11.0 and R v4.5.3.</p>
                <h3 id="quality-control-proxies">Quality-control proxies</h3>
                <p>Because downstream analyses were based on joined metagenomic profiling tables, table-derived
                    quality-control proxies were used to evaluate possible technical differences between groups. These
                    included GeneFamily_UNMAPPED_CPM, Pathway_UNINTEGRATED_CPM, numbers of detected species, numbers of
                    detected pathways and numbers of detected gene families. The primary models were intentionally
                    minimal because individual-level covariates were unavailable. Sensitivity models included
                    log-transformed GeneFamily_UNMAPPED_CPM.</p>
                <h3 id="species-level-ecological-metrics">Species-level ecological metrics</h3>
                <p>Species-level ecological metrics were calculated from the MetaPhlAn species abundance table. Species
                    richness was defined as the number of detected species per sample. Shannon diversity was calculated
                    from species relative abundances after normalizing sample-level species profiles to sum to one, and
                    effective species number was defined as <span class="tex-inline">\exp(\text{Shannon
                        diversity})</span>. Dominance was the maximum species relative abundance within a sample.
                    Top-five species fraction was the summed relative abundance of the five most abundant species. A
                    composite species contraction score was calculated as:</p>
                <div class="tex-display">\text{SpeciesContractionScore} = z(\text{Dominance}) +
                    z(\text{Top5SpeciesFraction}) - z(\text{SpeciesRichness}) - z(\text{EffectiveSpeciesNumber}),</div>
                <p>where <span class="tex-inline">z(\cdot)</span> denotes standardization across all included samples.
                    Higher values indicate a more concentrated species-level community structure.</p>
                <h3 id="coverage-qualified-pathway-universe">Coverage-qualified pathway universe</h3>
                <p>A global pathway universe was constructed before calculating species-pathway contribution metrics.
                    HUMAnN technical rows, including UNMAPPED, UNINTEGRATED and UNGROUPED, were excluded. A pathway was
                    included in the primary universe if it satisfied all of the following criteria: sample-level pathway
                    coverage <span class="tex-inline">\geq 0.5</span>, unstratified pathway abundance <span
                        class="tex-inline">&gt; 0</span> CPM and joint prevalence <span class="tex-inline">\geq
                        20\%</span> across all included samples. This procedure yielded 88 coverage-qualified pathways.
                </p>
                <h3 id="species-pathway-contribution-architecture">Species-pathway contribution architecture</h3>
                <p>Species-pathway contribution architecture was quantified using the HUMAnN stratified pathway
                    abundance table [22]. For each sample, pathway and contributor species, an effective species-pathway
                    edge was retained if the pathway belonged to the global pathway universe, sample-level pathway
                    coverage was at least 0.5, unstratified pathway abundance was greater than 0 CPM, stratified
                    contributor CPM exceeded <span class="tex-inline">0.18531327</span> CPM, and stratified contributor
                    CPM represented at least <span class="tex-inline">1\%</span> of the corresponding HUMAnN
                    unstratified pathway CPM. The first-percentile CPM threshold was <span
                        class="tex-inline">0.18531327</span> CPM.</p>
                <p>For a given sample and pathway <span class="tex-inline">p</span>, let <span
                        class="tex-inline">A_{p,i}</span> denote the CPM contribution from species <span
                        class="tex-inline">i</span>, and <span class="tex-inline">p_i = A_{p,i} / \sum_i A_{p,i}</span>.
                    Contributor richness was the number of effective contributor species for pathway <span
                        class="tex-inline">p</span>. Functional redundancy index (FRI) was calculated as:</p>
                <div class="tex-display">\text{FRI}_p = 1 - \sum_i p_i^2.</div>
                <p>FRI is used here as a contribution-diversity or redundancy-like architecture metric; it should not be
                    interpreted as direct evidence of ecological compensation capacity. <span
                        class="tex-inline">\text{TopContributorFraction}_p</span> was <span
                        class="tex-inline">\max_i(p_i)</span>. <span
                        class="tex-inline">\text{AttributedFraction}_p</span> was defined as <span
                        class="tex-inline">\sum_i A_{p,i} / A_{p,\text{unstratified}}</span>. The primary analysis used
                    sample-pathway observations with <span class="tex-inline">\text{AttributedFraction}_p \geq
                        0.5</span>. Sensitivity analyses used thresholds of 0.0, 0.5 and 0.7.</p>
                <h3 id="sample-level-functional-streamlining-metrics">Sample-level functional streamlining metrics</h3>
                <p>Sample-level contribution architecture metrics were obtained by averaging pathway-level values across
                    eligible pathways within each sample. These included MeanContributorRichness, MeanFRI and
                    MeanTopContributorFraction. FunctionalStreamliningScore was defined as:</p>
                <div class="tex-display">\text{FunctionalStreamliningScore} = z(\text{MeanTopContributorFraction}) -
                    z(\text{MeanFRI}) - z(\text{MeanContributorRichness}).</div>
                <p>Higher values indicate a more concentrated pathway contribution architecture, in which pathway
                    functions are carried by fewer and more dominant contributors.</p>
                <h3 id="bile-acid-associated-candidate-carrier-taxa">Bile-acid-associated candidate carrier taxa</h3>
                <p>Bile-acid-associated candidate carrier taxa were defined a priori based on previously reported
                    bile-acid-metabolizing taxa and the biological focus of the reanalysis [7-12]. The candidate set
                    included <em>Alistipes</em>, <em>Odoribacter</em>, <em>Parabacteroides</em>, <em>Clostridium
                        scindens</em> and <em>Eggerthella lenta</em>. These taxa were used to construct ecological proxy
                    metrics rather than direct enzymatic or metabolite-based measures of bile acid biosynthesis.</p>
                <p>Bile-acid carrier richness was defined as the number of detected candidate carrier taxa per sample.
                    BA_Carrier_Balance was calculated as:</p>
                <div class="tex-display">\text{BA_Carrier_Balance} = \log\left(\frac{\text{BA_Carrier_SumAbundance} +
                    10^{-6}}{\text{Non_BA_Carrier_Species_SumAbundance} + 10^{-6}}\right).</div>
                <p>BA_Carrier_SumAbundance is the summed MetaPhlAn relative abundance of predefined candidate BA carrier
                    taxa, and Non_BA_Carrier_Species_SumAbundance is the summed abundance of all remaining detected
                    species in the retained species table. The same pseudocount, <span
                        class="tex-inline">10^{-6}</span>, was applied uniformly.</p>
                <h3 id="butyrate-producer-taxa">Butyrate-producer taxa</h3>
                <p>Butyrate-producer-associated ecology was evaluated using a predefined candidate set consisting of
                    <em>Faecalibacterium prausnitzii</em>, <em>Eubacterium rectale</em> and <em>Roseburia
                        intestinalis</em> [17-19]. Butyrate-producer richness and summed abundance were calculated from
                    the MetaPhlAn species table. ButyrateDepletionBalance was calculated analogously:
                </p>
                <div class="tex-display">\text{ButyrateDepletionBalance} =
                    \log\left(\frac{\text{ButyrateProducer_SumAbundance} +
                    10^{-6}}{\text{Non_ButyrateProducer_Species_SumAbundance} + 10^{-6}}\right).</div>
                <p>Lower values indicate depletion of butyrate-producer-associated taxa.</p>
                <h3 id="bile-acid-carrier-taxon-stratified-gene-family-proxy">Bile-acid carrier taxon-stratified
                    gene-family proxy</h3>
                <p>To quantify gene-family signal attributable to candidate bile-acid carrier taxa, HUMAnN stratified
                    gene-family rows contributed by the predefined carrier taxa were extracted from the UniRef90
                    gene-family table. For each sample, we calculated BA_Carrier_TaxonStratifiedGeneFamilyCPMSum,
                    BA_Carrier_TaxonStratifiedGeneFamilyDetectedCount and BA_Carrier_DistinctGeneFamilyDetectedCount.
                    Detection was defined as CPM <span class="tex-inline">&gt; 0</span>. These metrics represent
                    taxon-stratified gene-family contribution proxies from candidate bile-acid carrier taxa. They were
                    not interpreted as targeted measurements of 5α-reductase, 3β-hydroxysteroid dehydrogenase,
                    5β-reductase, bai genes or isoalloLCA biosynthetic capacity.</p>
                <h3 id="integrated-indices">Integrated indices</h3>
                <p>Supportive integrated indices were calculated using <span class="tex-inline">z</span>-standardized
                    sample-level metrics. SpeciesSimplificationIndex was defined as <span
                        class="tex-inline">-z(\text{SpeciesRichness}) - z(\text{EffectiveSpeciesNumber})</span>.
                    BACarrierEcologyIndex was defined as
                </p>
                <div class="tex-display">z(\text{BA_Carrier_Balance}) + z(\text{BA_Carrier_Richness}) + z(\log(1 +
                    \text{BA_Carrier_TaxonStratifiedGeneFamilyCPMSum}))</div>
                <p>
                    ButyrateDepletionIndex was defined as
                </p>
                <div class="tex-display">-z(\text{ButyrateDepletionBalance}) - z(\text{ButyrateProducer_SumAbundance}) -
                    z(\text{ButyrateProducer_Richness})</div>
                <p>
                    IntegratedLongevityEcologyScore was defined as
                </p>
                <div class="tex-display">z(\text{SpeciesSimplificationIndex}) + z(\text{FunctionalStreamliningScore}) +
                    z(\text{BACarrierEcologyIndex}) + z(\text{ButyrateDepletionIndex})</div>
                <h3 id="statistical-analysis">Statistical analysis</h3>
                <p>Unless otherwise specified, group differences were evaluated using linear models of the form
                </p>
                <div class="tex-display">\text{Score} \sim \text{Group}</div>
                <p>
                    where Group compared centenarian samples with older controls. For sensitivity analyses of potential
                    mapping-efficiency effects, models used
                </p>
                <div class="tex-display">\text{Score} \sim \text{Group} + \log(1 + \text{GeneFamily_UNMAPPED_CPM})</div>
                <p>
                    Model coefficients are reported as the estimated difference between centenarians and older controls.
                    Heteroscedasticity-consistent HC3 robust standard errors were used for linear models. All
                    statistical tests were two-sided. For families of related endpoints or pathway-level analyses,
                    Benjamini-Hochberg false-discovery-rate correction was applied [25].</p>
                <h3 id="data-availability">Data availability</h3>
                <p>Raw sequencing data are publicly available under BioProject accession PRJNA675598. The final sample
                    manifest used in this reanalysis, including sample identifiers and group labels, will be provided as
                    Supplementary Table 1. Processed tables generated in this study will be made available upon
                    publication or deposited with the analysis code.</p>
                <h3 id="code-availability">Code availability</h3>
                <p>All scripts required to reproduce the downstream analyses can download from the Github repository：https://github.com/Han-Tao-scut/stool_metagenomics.git.</p>
                <h2 id="supplementary-tables">Supplementary tables</h2>
                <p><strong>Supplementary Table 1 | Final sample manifest and group assignment.</strong> Sample
                    identifiers, group labels and inclusion status for the 208 metagenomes retained in the locked
                    analysis dataset.</p>
                <p><strong>Supplementary Table 2 | Table-derived quality-control metrics.</strong> Sample-level
                    GeneFamily_UNMAPPED_CPM, Pathway_UNINTEGRATED_CPM, detected species counts, detected pathway counts
                    and detected gene-family counts.</p>
                <p><strong>Supplementary Table 3 | Species-level ecological metrics and models.</strong>
                    SpeciesRichness, EffectiveSpeciesNumber, Dominance, Top5SpeciesFraction, SpeciesContractionScore and
                    corresponding primary and GeneFamily_UNMAPPED-adjusted models.</p>
                <p><strong>Supplementary Table 4 | Coverage-qualified pathway universe.</strong> HUMAnN pathway
                    prevalence, coverage, unstratified CPM summaries and the 88 pathways retained in the primary
                    universe.</p>
                <p><strong>Supplementary Table 5 | Species-pathway contribution architecture metrics.</strong> Effective
                    species-pathway edges, sample-pathway-level ContributorRichness, FRI, TopContributorFraction,
                    AttributedFraction and sample-level summaries across AttributedFraction thresholds of 0.0, 0.5 and
                    0.7.</p>
                <p><strong>Supplementary Table 6 | Candidate BA carrier and butyrate-producer taxa metrics.</strong>
                    BA_Carrier_SumAbundance, BA_Carrier_Richness, BA_Carrier_Balance, ButyrateProducer_SumAbundance,
                    ButyrateProducer_Richness, ButyrateDepletionBalance and candidate taxon-level abundance and
                    detection summaries.</p>
                <p><strong>Supplementary Table 7 | BA carrier taxon-stratified gene-family proxy.</strong>
                    BA_Carrier_TaxonStratifiedGeneFamilyCPMSum, BA_Carrier_TaxonStratifiedGeneFamilyDetectedCount,
                    BA_Carrier_DistinctGeneFamilyDetectedCount, taxon-level gene-family CPM summaries and corresponding
                    models.</p>
                <p><strong>Supplementary Table 8 | Integrated indices and correlation network edges.</strong>
                    SpeciesSimplificationIndex, BACarrierEcologyIndex, ButyrateDepletionIndex,
                    IntegratedLongevityEcologyScore and Spearman correlation network edges among core ecological
                    metrics.</p>
                <h2 id="references">References</h2>
                <ol>
                    <li>Hirata, T. et al. Associations of cardiovascular biomarkers and plasma albumin with exceptional
                        survival to the highest ages. <em>Nat. Commun.</em> <strong>11</strong>, 3820 (2020).</li>
                    <li>Franceschi, C., Garagnani, P., Parini, P., Giuliani, C. &amp; Santoro, A. Inflammaging: a new
                        immune-metabolic viewpoint for age-related diseases. <em>Nat. Rev. Endocrinol.</em>
                        <strong>14</strong>, 576-590 (2018).
                    </li>
                    <li>Biagi, E. et al. Gut microbiota and extreme longevity. <em>Curr. Biol.</em> <strong>26</strong>,
                        1480-1485 (2016).</li>
                    <li>Wu, L. et al. A cross-sectional study of compositional and functional profiles of gut microbiota
                        in Sardinian centenarians. <em>mSystems</em> <strong>4</strong>, e00325-19 (2019).</li>
                    <li>Rampelli, S. et al. Shotgun metagenomics of gut microbiota in humans with up to extreme
                        longevity and the increasing role of xenobiotic degradation. <em>mSystems</em>
                        <strong>5</strong>, e00124-20 (2020).
                    </li>
                    <li>Badal, V. D. et al. The gut microbiome, aging, and longevity: a systematic review.
                        <em>Nutrients</em> <strong>12</strong>, 3759 (2020).
                    </li>
                    <li>Sato, Y. et al. Novel bile acid biosynthetic pathways are enriched in the microbiome of
                        centenarians. <em>Nature</em> <strong>599</strong>, 458-464 (2021).</li>
                    <li>Ridlon, J. M., Kang, D. J. &amp; Hylemon, P. B. Bile salt biotransformations by human intestinal
                        bacteria. <em>J. Lipid Res.</em> <strong>47</strong>, 241-259 (2006).</li>
                    <li>Ridlon, J. M., Harris, S. C., Bhowmik, S., Kang, D. J. &amp; Hylemon, P. B. Consequences of bile
                        salt biotransformations by intestinal bacteria. <em>Gut Microbes</em> <strong>7</strong>, 22-39
                        (2016).</li>
                    <li>Devlin, A. S. &amp; Fischbach, M. A. A biosynthetic pathway for a prominent class of
                        microbiota-derived bile acids. <em>Nat. Chem. Biol.</em> <strong>11</strong>, 685-690 (2015).
                    </li>
                    <li>Funabashi, M. et al. A metabolic pathway for bile acid dehydroxylation by the gut microbiome.
                        <em>Nature</em> <strong>582</strong>, 566-570 (2020).
                    </li>
                    <li>Buffie, C. G. et al. Precision microbiome reconstitution restores bile acid-mediated resistance
                        to <em>Clostridium difficile</em>. <em>Nature</em> <strong>517</strong>, 205-208 (2015).</li>
                    <li>Thanissery, R., Winston, J. A. &amp; Theriot, C. M. Inhibition of spore germination, growth, and
                        toxin activity of clinically relevant <em>C. difficile</em> strains by gut microbiota-derived
                        secondary bile acids. <em>Anaerobe</em> <strong>45</strong>, 86-100 (2017).</li>
                    <li>Hang, S. et al. Bile acid metabolites control TH17 and Treg cell differentiation.
                        <em>Nature</em> <strong>576</strong>, 143-148 (2019).
                    </li>
                    <li>Song, X. et al. Microbial bile acid metabolites modulate gut RORγ+ regulatory T cell
                        homeostasis. <em>Nature</em> <strong>577</strong>, 410-415 (2020).</li>
                    <li>Campbell, C. et al. Bacterial metabolism of bile acids promotes generation of peripheral
                        regulatory T cells. <em>Nature</em> <strong>581</strong>, 475-479 (2020).</li>
                    <li>Furusawa, Y. et al. Commensal microbe-derived butyrate induces the differentiation of colonic
                        regulatory T cells. <em>Nature</em> <strong>504</strong>, 446-450 (2013).</li>
                    <li>Smith, P. M. et al. The microbial metabolites, short-chain fatty acids, regulate colonic Treg
                        cell homeostasis. <em>Science</em> <strong>341</strong>, 569-573 (2013).</li>
                    <li>Arpaia, N. et al. Metabolites produced by commensal bacteria promote peripheral regulatory
                        T-cell generation. <em>Nature</em> <strong>504</strong>, 451-455 (2013).</li>
                    <li>Tian, L. et al. Deciphering functional redundancy in the human microbiome. <em>Nat. Commun.</em>
                        <strong>11</strong>, 6217 (2020).
                    </li>
                    <li>Miki, T., Yokokawa, T. &amp; Matsui, K. Biodiversity and multifunctionality in a microbial
                        community: a novel theoretical approach to quantify functional redundancy. <em>Proc. R. Soc.
                            B</em> <strong>281</strong>, 20132498 (2014).</li>
                    <li>Franzosa, E. A. et al. Species-level functional profiling of metagenomes and metatranscriptomes.
                        <em>Nat. Methods</em> <strong>15</strong>, 962-968 (2018).
                    </li>
                    <li>Beghini, F. et al. Integrating taxonomic, functional, and strain-level profiling of diverse
                        microbial communities with bioBakery 3. <em>eLife</em> <strong>10</strong>, e65088 (2021).</li>
                    <li>Chen, S., Zhou, Y., Chen, Y. &amp; Gu, J. fastp: an ultra-fast all-in-one FASTQ preprocessor.
                        <em>Bioinformatics</em> <strong>34</strong>, i884-i890 (2018).
                    </li>
                    <li>Benjamini, Y. &amp; Hochberg, Y. Controlling the false discovery rate: a practical and powerful
                        approach to multiple testing. <em>J. R. Stat. Soc. B</em> <strong>57</strong>, 289-300 (1995).
                    </li>
                </ol>
            </article>
        </div>

        <section class="card article-downloads">
            <h2>补充材料下载</h2>
            <ul class="file-list">
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_1.xlsx" download>
                        <span>Supplementary_Table_1</span>
                        <small>XLSX · 45.5 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_2.xlsx" download>
                        <span>Supplementary_Table_2</span>
                        <small>XLSX · 32.6 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_3.xlsx" download>
                        <span>Supplementary_Table_3</span>
                        <small>XLSX · 66.2 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_4.xlsx" download>
                        <span>Supplementary_Table_4</span>
                        <small>XLSX · 96.1 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_5.xlsx" download>
                        <span>Supplementary_Table_5</span>
                        <small>XLSX · 12.09 MB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_6.xlsx" download>
                        <span>Supplementary_Table_6</span>
                        <small>XLSX · 67.3 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_7.xlsx" download>
                        <span>Supplementary_Table_7</span>
                        <small>XLSX · 193.1 KB</small>
                    </a>
                </li>
                <li>
                    <a href="article/supplementary_tables/Supplementary_Table_8.xlsx" download>
                        <span>Supplementary_Table_8</span>
                        <small>XLSX · 60.4 KB</small>
                    </a>
                </li>
            </ul>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
    <!-- MathJax 配置 -->
    <script>
        MathJax = {
            tex: {
                inlineMath: [
                    ['$', '$'],
                    ['\\(', '\\)']
                ],
                displayMath: [
                    ['$$', '$$'],
                    ['\\[', '\\]']
                ]
            },
            svg: {
                fontCache: 'global'
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tex-inline').forEach(function(el) {
                el.textContent = '$' + el.textContent + '$';
            });

            document.querySelectorAll('.tex-display').forEach(function(el) {
                el.textContent = '$$' + el.textContent + '$$';
            });

            if (window.MathJax) {
                MathJax.contentDocument = document;
                MathJax.typesetPromise([document.body]).catch(err => console.log(err));
            }
        });
    </script>

</body>

</html>
