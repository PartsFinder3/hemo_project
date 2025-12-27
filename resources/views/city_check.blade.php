
<section class="seo_content">
     <hr style="
    border: none;
    border-top: 4px solid #FF7100;
    opacity: 1;
    margin: 30px 0;
">
    {!! $content !!}
    <hr style="
    border: none;
    border-top: 4px solid #FF7100;
    opacity: 1;
    margin: 30px 0;
">

<style>
    

/* SEO Content Section */
.seo_content {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.8;
    color: #2d3748;
    max-width: 90%;
    font-size: 16px;
    margin: auto;
}

/* Headings */
.seo_content h1,
.seo_content h2,
.seo_content h3,
.seo_content h4,
.seo_content h5,
.seo_content h6 {
    font-weight: 700;
    line-height: 1.3;
    margin-top: 0,5em;
    margin-bottom: 0.10em;
    color: #1a202c;
}

.seo_content h1 {
    border-bottom: none; /* پہلے لائن تھی، اب ختم */
    padding-bottom: 0; /* padding optional */
}

.seo_content h2 {
    border-left: none; /* پہلے لائن تھی، اب ختم */
    padding-left: 0; /* padding optional */
}

.seo_content h3 {
    font-size: 1.5rem;
    color: #2d3748;
}

.seo_content h4 {
    font-size: 1.25rem;
}

.seo_content h5 {
    font-size: 1.125rem;
}

.seo_content h6 {
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Paragraphs */
.seo_content p {
    
    text-align: justify;
}

/* Links */
.seo_content a {
    color: #3182ce;
    text-decoration: none;
    border-bottom: 1px dotted #3182ce;
    transition: all 0.3s ease;
}

.seo_content a:hover {
    color: #2c5282;
    border-bottom: 1px solid #2c5282;
}

/* Lists */
.seo_content ul,
.seo_content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.seo_content li {
    margin-bottom: 0.75rem;
    position: relative;
}

.seo_content ul li:before {
    content: "•";
    color: #4299e1;
    font-weight: bold;
    position: absolute;
    left: -1rem;
}

/* Images */
.seo_content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Tables */
.seo_content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.seo_content th {
    background-color: #edf2f7;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid #cbd5e0;
}

.seo_content td {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.seo_content tr:hover {
    background-color: #f7fafc;
}

/* Blockquotes */
.seo_content blockquote {
    background: linear-gradient(90deg, #ebf8ff 0%, transparent 100%);
    border-left: 4px solid #4299e1;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #4a5568;
}

/* Code blocks */
.seo_content pre {
    background-color: #1a202c;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 2rem 0;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.875rem;
}

.seo_content code {
    background-color: #f7fafc;
    color: #e53e3e;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Monaco', 'Menlo', monospace;
    font-size: 0.875rem;
}

.seo_content pre code {
    background: transparent;
    color: inherit;
    padding: 0;
}



/* Strong and Emphasis */
.seo_content strong {
    color: #2d3748;
    font-weight: 700;
}

.seo_content em {
    color: #4a5568;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .seo_content {
        font-size: 15px;
        line-height: 1.7;
    }
    
    .seo_content h1 {
        font-size: 1.75rem;
    }
    
    .seo_content h2 {
        font-size: 1.5rem;
    }
    
    .seo_content h3 {
        font-size: 1.25rem;
    }
    
    .seo_content table {
        display: block;
        overflow-x: auto;
    }
}

/* Additional SEO-friendly spacing */
.seo_content > *:first-child {
    margin-top: 0 !important;
}

.seo_content > *:last-child {
    margin-bottom: 0 !important;
}
</style>