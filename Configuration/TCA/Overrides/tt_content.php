<?php declare(strict_types=1);

/*
 * This file is part of the package ucph_content_background.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sept. 2023, University of Copenhagen.
 */

defined('TYPO3') or die();

call_user_func(function ($extKey ='ucph_content_background') {
    // Register fields
    $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['columns'],
        [
            'tx_ucph_content_bg_color' => [
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_page_color_select',
                'onChange' => 'reload',
                'displayCond' => [
                    'OR' => [
                        // Only add background color select box in these grid CTypes
                        'FIELD:CType:=:ucph_content_container_grids',
                        'FIELD:CType:=:container_1_columns',
                        'FIELD:CType:=:container_2_columns',
                        'FIELD:CType:=:container_2_columns_right',
                        'FIELD:CType:=:container_2_columns_left',
                        'FIELD:CType:=:container_3_columns',
                        'FIELD:CType:=:container_4_columns',
                        'FIELD:CType:=:container_indent_columns',
                    ]
                 ],
                'exclude' => true,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-unset',
                            '',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-1',
                            'subset-color-1',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-2',
                            'subset-color-2',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-3',
                            'subset-color-3',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-4',
                            'subset-color-4',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-5',
                            'subset-color-5',
                        ],
                        [
                            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:color-6',
                            'subset-color-6',
                        ],
                    ],
                ],
                'default' => '',
            ],
            'tx_ucph_content_background_image' => [
                'exclude' => true,
                'displayCond' => [
                    'OR' => [
                        // Only add background color select box in these grid CTypes
                        'FIELD:CType:=:ucph_content_container_grids',
                        'FIELD:CType:=:container_1_columns',
                        'FIELD:CType:=:container_2_columns',
                        'FIELD:CType:=:container_2_columns_right',
                        'FIELD:CType:=:container_2_columns_left',
                        'FIELD:CType:=:container_3_columns',
                        'FIELD:CType:=:container_4_columns',
                        'FIELD:CType:=:container_indent_columns',
                    ],
                    'AND' => [
                        // If no background color is selected
                        'FIELD:tx_ucph_content_bg_color:=:',
                    ],
                 ],
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:field.background_image',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'image',
                    [
                        'minitems' => 0,
                        'maxitems' => 1,
                        'appearance' => [
                            'elementBrowserType' => 'file',
                            'elementBrowserAllowed' => 'jpg,jpeg,png,svg'
                        ],
                        'filter' => [
                            0 => [
                                'parameters' => [
                                    'allowedFileExtensions' => 'jpg,jpeg,png,svg',
                                ],
                            ],
                        ],
                        'overrideChildTca' => [
                            'columns' => [
                                'uid_local' => [
                                    'config' => [
                                        'appearance' => [
                                            'elementBrowserAllowed' => 'jpg,jpeg,png,svg',
                                        ],
                                    ],
                                ],
                            ],
                            'types' => [
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                        crop,
                                    --palette--;;filePalette'
                                ]
                            ],
                        ],
                    ],
                    $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
                ),
                'l10n_mode' => 'exclude',
            ],
            'tx_ucph_content_background_image_options' => [
                'displayCond' => [
                    'OR' => [
                        // Only add background color select box in these grid CTypes
                        'FIELD:CType:=:ucph_content_container_grids',
                        'FIELD:CType:=:container_1_columns',
                        'FIELD:CType:=:container_2_columns',
                        'FIELD:CType:=:container_2_columns_right',
                        'FIELD:CType:=:container_2_columns_left',
                        'FIELD:CType:=:container_3_columns',
                        'FIELD:CType:=:container_4_columns',
                        'FIELD:CType:=:container_indent_columns',
                    ],
                    'AND' => [
                        // If no background color is selected
                        'FIELD:tx_ucph_content_bg_color:=:',
                    ],
                 ],
                'exclude' => true,
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:field.background_image_options',
                'config' => [
                    'type' => 'flex',
                    'ds' => [
                        'default' => 'FILE:EXT:' . $extKey . '/Configuration/FlexForms/BackgroundImage.xml',
                    ],
                ],
                'l10n_mode' => 'exclude',
            ],
        ]
    );

    // Add in tab "Appearence"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'tx_ucph_content_bg_color, tx_ucph_content_background_image, tx_ucph_content_background_image_options',
        '',
        'after:space_after_class'
    );
});
