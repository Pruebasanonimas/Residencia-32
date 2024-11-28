<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionPersonalizada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CSVController extends Controller
{
   //Función para mostrar el formulario de correos
    public function showForm()
    {
        return view('emails.upload_csv_form');
    }

    /**
     * Procesa el archivo CSV y envía correos electrónicos a cada dirección en el archivo.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    //Función para enviar correos
    public function enviarCorreosDesdeCSV(Request $request)
    {
        
        $request->validate([
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'csv_file' => 'required|file|mimes:csv,txt', 
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx' 
        ]);

       
        $data = [
            'subject' => $request->input('subject'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'attachments' => $request->file('attachments', [])
        ];

       
        $csvFile = $request->file('csv_file');
        $emails = $this->getEmailsFromCSV($csvFile);

       
        foreach ($emails as $email) {
            $data['email'] = $email;

            try {
               
                Mail::to($email)->send(new NotificacionPersonalizada($data));
            } catch (\Exception $e) {
              
                return back()->withErrors(['error' => 'Error al enviar correos: ' . $e->getMessage()]);
            }
        }

        return back()->with('success', 'Correos enviados exitosamente');
    }

    /**
     * Lee el archivo CSV y extrae los correos electrónicos.
     *
     * @param \Illuminate\Http\UploadedFile $csvFile
     * @return array
     */

    //Función para obtener los correos electronicos del CSV
    private function getEmailsFromCSV($csvFile)
    {
        $emails = [];

     
        $delimiter = $this->detectDelimiter($csvFile);

     
        if (($handle = fopen($csvFile->getRealPath(), 'r')) !== false) {
           
            $header = fgetcsv($handle, 1000, $delimiter);

            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
               
                if (filter_var($row[0], FILTER_VALIDATE_EMAIL)) {
                    $emails[] = $row[0];
                }
            }
            fclose($handle);
        }

        return $emails;
    }

    /**
     * Detecta el delimitador del archivo CSV.
     *
     * @param \Illuminate\Http\UploadedFile $csvFile
     * @return string
     */

    //Función para aceptar varios caracteres en los CSV
    private function detectDelimiter($csvFile)
    {
        $firstLine = fgets(fopen($csvFile->getRealPath(), 'r'));

    
        if (strpos($firstLine, ',') !== false) {
            return ',';
        } elseif (strpos($firstLine, ';') !== false) {
            return ';';
        } elseif (strpos($firstLine, "\t") !== false) {
            return "\t";
        }

    
        return ',';
    }
}
