<?php
/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
$header = <<<'EOF'
This file is part of PHP CS Fixer.
(c) Fabien Potencier <fabien@symfony.com>
    Dariusz Rumiński <dariusz.ruminski@gmail.com>
This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;
$finder = PhpCsFixer\Finder::create()
    ->notPath('.ebextensions')
    ->notPath('.elasticbeanstalk')
    ->notPath('docs')
    ->notPath('public')
    ->notPath('resources')
    ->notPath('storage')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;
$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        // default settings copied from package
        '@PHP71Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']],
        'header_comment' => ['header' => $header],
        // custom from here
        '@PSR2'                                       => true,
        'array_syntax'                                => ['syntax' => 'short'],
        'ordered_imports'                             => ['sort_algorithm' => 'alpha'],
        'binary_operator_spaces'                      => [
            'operators' => [
                '=>' => 'align_single_space_minimal'
            ]
        ],
        'blank_line_after_namespace'                  => true,
        'blank_line_after_opening_tag'                => true,
        'braces'                                      => true,
        'cast_spaces'                                 => true,
        'concat_space'                                => ['spacing' => 'one'],
        'class_definition'                            => true,
        'elseif'                                      => true,
        'encoding'                                    => true,
        'full_opening_tag'                            => true,
        'function_declaration'                        => true,
        'function_typehint_space'                     => true,
        'heredoc_to_nowdoc'                           => true,
        'include'                                     => true,
        'lowercase_cast'                              => true,
        'lowercase_keywords'                          => true,
        'method_argument_space'                       => true,
        'native_function_invocation'                  => true,
        'native_function_casing'                      => true,
        'new_with_braces'                             => true,
        // 'no_alias_functions'                          => true,
        'no_blank_lines_after_class_opening'          => true,
        'no_blank_lines_after_phpdoc'                 => true,
        'no_closing_tag'                              => true,
        'no_empty_phpdoc'                             => true,
        'no_leading_import_slash'                     => true,
        'no_leading_namespace_whitespace'             => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons'      => false,
        'no_short_bool_cast'                          => true,
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_after_function_name'               => true,
        'no_spaces_inside_parenthesis'                => true,
        'no_superfluous_phpdoc_tags'                  => true,
        'no_trailing_comma_in_list_call'              => true,
        'no_trailing_comma_in_singleline_array'       => true,
        'no_trailing_whitespace'                      => true,
        'no_trailing_whitespace_in_comment'           => true,
        'no_unneeded_control_parentheses'             => true,
        // 'no_unreachable_default_argument_value'       => true,
        'no_unused_imports'                           => true,
        'no_useless_return'                           => true,
        'no_whitespace_before_comma_in_array'         => true,
        'not_operator_with_successor_space'           => true,
        'object_operator_without_whitespace'          => true,
        'phpdoc_align'                                => true,
        'phpdoc_indent'                               => true,
        'phpdoc_line_span'                            => true,
        'phpdoc_no_access'                            => true,
        'phpdoc_no_package'                           => true,
        'phpdoc_order'                                => true,
        'phpdoc_scalar'                               => true,
        'phpdoc_separation'                           => true,
        'phpdoc_summary'                              => true,
        'phpdoc_to_comment'                           => true,
        'phpdoc_trim'                                 => true,
        'phpdoc_types'                                => true,
        'phpdoc_var_without_name'                     => true,
        'no_mixed_echo_print'                         => true,
        // 'psr4'                                        => true,
        'self_accessor'                               => true,
        'short_scalar_cast'                           => true,
        // 'simplified_null_return'                      => true,
        'single_blank_line_at_eof'                    => true,
        'single_blank_line_before_namespace'          => true,
        'single_import_per_statement'                 => true,
        'single_line_after_imports'                   => true,
        'single_quote'                                => true,
        'return_type_declaration'                     => ['space_before' => 'none'],
        'space_after_semicolon'                       => true,
        'standardize_not_equals'                      => true,
        'switch_case_semicolon_to_colon'              => true,
        'switch_case_space'                           => true,
        'ternary_operator_spaces'                     => true,
        'trailing_comma_in_multiline'                 => true,
        'trim_array_spaces'                           => true,
        'unary_operator_spaces'                       => true,
        'visibility_required'                         => true,
        'whitespace_after_comma_in_array'             => true,
        'void_return'                                 => true,
    ])
    ->setFinder($finder)
;
// special handling of fabbot.io service if it's using too old PHP CS Fixer version
if (false !== getenv('FABBOT_IO')) {
    try {
        PhpCsFixer\FixerFactory::create()
            ->registerBuiltInFixers()
            ->registerCustomFixers($config->getCustomFixers())
            ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()))
        ;
    } catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
        $config->setRules([]);
    } catch (UnexpectedValueException $e) {
        $config->setRules([]);
    } catch (InvalidArgumentException $e) {
        $config->setRules([]);
    }
}
return $config;
