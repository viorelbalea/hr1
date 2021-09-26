<?php

class Revisal
{

    public static function getCetatenii()
    {

        global $conn;

        $query = "SELECT * FROM revisal_cetatenii";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['CetatenieID']] = $row['CetatenieDenumire'];
        }
        return $res;
    }

    public static function getFormeJuridice()
    {

        global $conn;

        $query = "SELECT * FROM revisal_forme_juridice";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['FormaJuridicaID']] = $row['FormaJuridicaDenumire'] . "( " . $row['FormaJuridicaAbreviere'] . " )";
        }
        return $res;
    }

    public static function getFormeOrganizare($info = "")
    {

        global $conn;

        $res = array();
        $cond = "";
        if (!empty($info))
            $cond = " AND FormaJuridicaID = $info ";

        $query = "SELECT * FROM revisal_forme_organizare WHERE 1=1 $cond";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['FormaOrganizareID']] = $row['FormaOrganizareDenumire'] . "( " . $row['FormaOrganizareAbreviere'] . " )";
        }
        return $res;
    }

    public static function getFormeProprietate()
    {

        global $conn;

        $query = "SELECT * FROM revisal_forme_proprietate";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['FormaProprietateID']] = $row['FormaProprietateDenumire'];
        }
        return $res;
    }

    public static function getItm()
    {

        global $conn;

        $query = "SELECT * FROM revisal_itm ORDER BY ItmDenumire ASC";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['ItmID']] = $row['ItmDenumire'];
        }
        return $res;
    }

    public static function getTipuriSocietate()
    {

        global $conn;

        $query = "SELECT * FROM revisal_tipuri_societate";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['TipSocietateID']] = $row['TipSocietateDenumire'];
        }
        return $res;
    }

    public static function exportXML()
    {

        $companies = Company::getSelfCompaniesData();
        $persons = Person::getEmployeesData(false);
        unset($persons[0]);
        $contracts = PayRoll::getPayrollContracts();

        //Utils::pa($contracts);

        $xml = '<?xml version="1.0" encoding="utf-8"?> <XmlReport xmlns:i="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://schemas.datacontract.org/2004/07/Revisal.Entities">';
        $xml .= '<Header>';
        $xml .= '<ClientApplication>Revisal</ClientApplication> 
    			<XmlVersion>0</XmlVersion> 
    			<UploadId i:nil="true"/> <UploadDescription i:nil="true"/>';

        //Angajatori
        foreach ($companies as $k => $v) {
            $xml .= "<Angajator>";
            $xml .= "<Adresa>{$v['AddressName']}</Adresa>";
            $xml .= "<Contact> 
    						<Email>{$v['CompanyEmail']}</Email> 
    						<Fax>{$v['LegalFax']}</Fax> 
    						<ReprezentantLegal>{$v['LegalFullName']}</ReprezentantLegal> 
    						<Telefon>{$v['LegalMobile']}</Telefon>
    					</Contact>";
            $xml .= "<Detalii i:type='DetaliiAngajatorPersoanaJuridica'> 
    						<DomeniuActivitate> 
    							<Cod>" . (int)$v['DomeniuActivitateCod'] . "</Cod> 
    							<Versiune>2</Versiune> 
    						</DomeniuActivitate> 
    							<Nume>{$v['CompanyName']}</Nume> 
    							<Cui>{$v['CIF']}</Cui> 
    							<CuiParinte i:nil='true'/> 
    							<FormaJuridicaPJ>SocietateComerciala</FormaJuridicaPJ> 
    							<FormaOrganizarePJ>SocietateCuRaspundereLimitata</FormaOrganizarePJ> 
    							<FormaProprietate>Stat</FormaProprietate> 
    							<NivelInfiintare>SediuSocial</NivelInfiintare> 
    							<NumeParinte i:nil='true'/> 
    					</Detalii>";
            $xml .= "<Localitate> ";
            //$xml.=	"<CodSiruta>{$v['RevisalCityID']}</CodSiruta>";
            $xml .= "<CodSiruta>13178</CodSiruta>";
            $xml .= "</Localitate>";
            $xml .= "</Angajator>";
        }
        $xml .= "</Header>";
        //Angajati
        $xml .= '<Salariati>';
        foreach ($persons as $k => $v) {
            $xml .= "<Salariat> 
    					<Adresa>{$v['AddressName']}</Adresa> 
    					<Cnp>{$v['CNP']}</Cnp> 
    					<CnpVechi i:nil='true'/>";

            $xml .= "<Contracte> 
    						<Contract> 
    							<Cor> 
    								<Cod>" . (int)$v['COR'] . "</Cod> 
    								<Versiune>5</Versiune> 
    							</Cor> ";
            if ($v['ContractDate'] != '0000-00-00' && !empty($v['ContractDate']))
                $xml .= "<DataConsemnare>{$v['ContractDate']}T00:00:00</DataConsemnare>";
            else
                $xml .= "<DataConsemnare>" . date('Y-m-d') . "T00:00:00</DataConsemnare>";

            if ($v['ContractDate'] != '0000-00-00' && !empty($v['ContractDate']))
                $xml .= "<DataContract>{$v['ContractDate']}T00:00:00</DataContract>";
            else
                $xml .= "<DataContract>" . date('Y-m-d') . "T00:00:00</DataContract>";

            if ($v['StartDate'] != '0000-00-00' && !empty($v['StartDate']))
                $xml .= "<DataInceputContract>{$v['StartDate']}T00:00:00</DataInceputContract>";
            else
                $xml .= "<DataInceputContract>" . date('Y-m-d') . "T00:00:00</DataInceputContract>";

            if ($v['ContractExpDate'] != '0000-00-00' && !empty($v['ContractExpDate']))
                $xml .= "<DataSfarsitContract>{$v['ContractExpDate']}T00:00:00</DataSfarsitContract>";
            else
                $xml .= "<DataSfarsitContract i:nil='true' />";
            $xml .= "	<DateContractVechi i:nil='true'/> 
    							<Detalii>{$v['Notes']}</Detalii>
								<ExceptieDataSfarsit i:nil='true'/> 
									<NumarContract>{$v['ContractNo']}</NumarContract> 
									<NumereContractVechi i:nil='true'/> 
									<Salariu>" . (int)$v['PersonSalary'] . "</Salariu> 
									<SporuriSalariu i:nil='true'/> 
									<StareCurenta i:type='ContractStareActiv'> 
									<DataIncetareDetasare i:nil='true' />";
            if ($v['ReturnDate'] != '0000-00-00' && !empty($v['ReturnDate']))
                $xml .= "<DataIncetareSuspendare>{$v['ReturnDate']}T00:00:00</DataIncetareSuspendare>";
            else
                $xml .= "<DataIncetareSuspendare i:nil='true' />	";
            $xml .= "<StarePrecedenta i:nil='true'/> 
									</StareCurenta> 
										<TimpMunca> 
											<IntervalTimp i:nil='true'/> 
											<Norma>NormaIntreaga840</Norma> 
											<Repartizare>OreDeZi</Repartizare> 
										</TimpMunca> 
									<TipContract>ContractIndividualMunca</TipContract> 
									<TipDurata>Nedeterminata</TipDurata> 
									<TipNorma>NormaIntreaga</TipNorma> 
							</Contract> 
						</Contracte>";
            $xml .= "<DetaliiSalariatStrain i:nil='true'/> 
    					<Localitate> ";
            //$xml.=	"<CodSiruta>{$v['RevisalCityID']}</CodSiruta>";
            $xml .= "<CodSiruta>13178</CodSiruta>";
            $xml .= "</Localitate> 
    					<Mentiuni i:nil='true'/> 
    					<Nationalitate> 
    						<Nume>" . utf8_encode('Rom�nia') . "</Nume> 
    					</Nationalitate> 
    					<Nume>{$v['LastName']}</Nume> 
    					<Prenume>{$v['FirstName']}</Prenume> 
    					<TipActIdentitate>CarteIdentitate</TipActIdentitate>";
            $xml .= "</Salariat>";
        }
        $xml .= "</Salariati>";
        $xml .= "</XmlReport>";

        return $xml;
        //echo $xml;
    }
}