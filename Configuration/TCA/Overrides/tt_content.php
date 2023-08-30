<?php declare(strict_types=1);

/*
 * This file is part of the package ucph_content_background.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sept. 2023, University of Copenhagen.
 */

defined('TYPO3') or die();

call_user_func(function ($extKey ='ucph_content_background') {

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'tx_ucph_content_bg_color' => [
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_page_color_select',
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
         ]
    );

    // Add in tab "Appearence"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'tx_ucph_content_bg_color',
        '',
        'after:space_after_class'
    );
});