<?php declare(strict_types=1);

defined('TYPO3') or die();

/**
 * Background image settings
 */

call_user_func(function ($extKey ='ucph_content_background') {
    // Register fields
    $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['columns'],
        [
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
                    ]
                 ],
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:field.background_image',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'image',
                    [
                        'minitems' => 0,
                        'maxitems' => 1,
                    ],
                    
                    $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
                ),
                'l10n_mode' => 'exclude',
            ],
            'tx_ucph_content_background_image_options' => [
                'exclude' => true,
                //'displayCond' => 'FIELD:tx_ucph_content_bg_color:!=:none',
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
        'tx_ucph_content_background_image, tx_ucph_content_background_image_options',
        '',
        'after:space_after_class'
    );
});
