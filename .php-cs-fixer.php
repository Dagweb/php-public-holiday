<?php

declare(strict_types=1);

$rules = [
    '@Symfony' => true,
    '@PSR1' => true,
    '@PSR2' => true,
    'array_syntax' => [
        'syntax' => 'short'
    ],
    'blank_line_after_namespace' => true,
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'case',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'phpdoc',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield',
            'yield_from',
        ],
    ],
    'blank_lines_before_namespace' => [
        'max_line_breaks' => 2,
        'min_line_breaks' => 2,
    ],
    'cast_spaces' => false,
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'none',
            'method' => 'one',
            'property' => 'only_if_meta'
        ]
    ],
    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,
    'compact_nullable_type_declaration' => true,
    'concat_space' => ['spacing' => 'one'],
    'constant_case' => true,
    'declare_strict_types' => true,
    'elseif' => true,
    'lowercase_cast' => true,
    'multiline_whitespace_before_semicolons' => true,
    'no_alternative_syntax' => true,
    'no_empty_statement' => true,
    'no_short_bool_cast' => true,
    'no_superfluous_elseif' => true,
    'no_trailing_whitespace' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'no_unset_cast' => true,
    'no_unused_imports' => true,
    'no_whitespace_in_blank_line' => true,
    'normalize_index_brace' => true,
    'not_operator_with_successor_space' => false,
    'nullable_type_declaration_for_default_null_value' => [
        'use_nullable_type_declaration' => true
    ],
    'ordered_imports' => [
        'sort_algorithm' => 'length',
    ],
    'ordered_interfaces' => true,
    'ordered_traits' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_to_comment' => [
        'ignored_tags' => ['psalm-suppress', 'var', 'TODO']
    ],
    'phpdoc_trim' => true,
    'phpdoc_var_without_name' => true,
    'short_scalar_cast' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'strict_comparison' => true,
    'ternary_operator_spaces' => true,
    'ternary_to_null_coalescing' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
];

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules($rules)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude([
                'vendor'
            ])
            ->notName('README.md')
            ->notName('*.xml')
            ->notName('*.yml')
            ->notName('_ide_helper.php')
    )
;
