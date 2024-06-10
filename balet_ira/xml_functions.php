<?php
function addUserToXML($user) {
    $file = 'users.xml';

    if (!file_exists($file)) {
        $xml = new SimpleXMLElement('<users/>');
    } else {
        $xml = simplexml_load_file($file);
    }

    $userNode = $xml->addChild('user');
    $userNode->addChild('id', $user['id']);
    $userNode->addChild('ime', $user['ime']);
    $userNode->addChild('prezime', $user['prezime']);
    $userNode->addChild('email', $user['email']);
    $userNode->addChild('role', $user['role']);

    $xml->asXML($file);
}

function addTerminToXML($termin) {
    $file = 'termini.xml';

    if (!file_exists($file)) {
        $xml = new SimpleXMLElement('<termini/>');
    } else {
        $xml = simplexml_load_file($file);
    }

    $terminNode = $xml->addChild('termin');
    $terminNode->addChild('id', $termin['id']);
    $terminNode->addChild('trener_id', $termin['trener_id']);
    $terminNode->addChild('datum', $termin['datum']);
    $terminNode->addChild('vrijeme', $termin['vrijeme']);
    $terminNode->addChild('lokacija', $termin['lokacija']);

    $xml->asXML($file);
}

function deleteTerminFromXML($terminId) {
    $file = 'termini.xml';

    if (!file_exists($file)) {
        return;
    }

    $xml = simplexml_load_file($file);

    foreach ($xml->termin as $termin) {
        if ($termin->id == $terminId) {
            $dom = dom_import_simplexml($termin);
            $dom->parentNode->removeChild($dom);
        }
    }

    $xml->asXML($file);
}
?>
